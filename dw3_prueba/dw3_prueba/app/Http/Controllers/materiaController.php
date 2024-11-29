<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;

class materiaController extends Controller
{
    public function inicio(){
        return view('materias.lista');
    }

    public function formularioVista(){
        return view('materias.formulario');
    }

    public function crearMateria(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|min:4',
            'nro_materia' => 'required|integer|min:6',
            'acta' => 'required|string|min:4',
            'estado' => 'required|string|min:4|in:activo,inactivo',
            'semestre' => 'required|string|min:4',
            'curso' => 'required|string|min:4',
            'anho' => 'required|date|before_or_equal:today',
            'docente' => 'required|string|min:4',
            'horas' => 'required|string'
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nro_materia.required' => 'El campo número de la materia es obligatorio.',
            'estado.in' => 'El estado debe ser activo o inactivo.',
            'anho.before_or_equal' => 'El año debe ser actual o en el pasado.',
            'horas.integer' => 'El campo horas debe ser un número entero.',
            'docente.required' => 'El campo docente es obligatorio.',
        ]);

        // Crear una nueva materia con Eloquent
        $materia = Materia::create([
            'nombre' => $request->nombre,
            'nro_materia' => $request->nro_materia,
            'acta' => $request->acta,
            'estado' => $request->estado,
            'semestre' => $request->semestre,
            'curso' => $request->curso,
            'anho' => $request->anho,
            'docente' => $request->docente,
            'horas' => $request->horas
        ]);

        // Redirigir a la ruta con un mensaje de éxito
        return redirect()->route('inicio')->with('success', 'Materia creada correctamente');
    }

    public function desactivar($id){
        Materia::where('id', $id)->update(['activo'=>0]);
        return redirect()->route('inicio')->with('success', 'Materias ha sido desactivado correctamente');
    }
    public function activar($id){
        Materia::where('id', $id)->update(['activo'=>1]);
        return redirect()->route('inicio')->with('success', 'Materias ha sido activado correctamente');
    }

    public function MateriasVista(Request $request){
        // Obtener todas las tarjetas ordenadas por nombre descendente con paginación
        $materias = Materia::orderBy('nombre', 'desc')->paginate(5);
        
        // Devolver la Materia con las tarjetas paginadas
        return view('materias.lista', compact('materias'));
    }

    public function eliminarMateria($id){
        $materias = Materia::find($id);
        if($materias->activo == 0){
            $materias->delete();
            return redirect()->route('inicio')->with('success', 'Materia eliminada correctamente');
        }else{
            return redirect()->route('inicio')->with('success', 'Materia no eliminada');
        };
    }

    public function actualizarMateria(Request $request, $id){
        $materias = Materia::where('id', $id);
        $materias->update([
            'nombre' => $request->nombre,
            'nro_materia' => $request->nro_materia,
            'acta' => $request->acta,
            'estado' => $request->estado,
            'semestre' => $request->semestre,
            'curso' => $request->curso,
            'anho' => $request->anho,
            'docente' => $request->docente,
            'horas' => $request->horas
        ]);
        
        return redirect()->route('inicio')->with('success', 'Materias ha sido actualizado correctamente');
    }
}
