<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarjetas; // Asegúrate de utilizar el nombre de la clase en singular y con la primera letra mayúscula

class TarjetaController extends Controller
{
    public function inicio()
    {
        return view('tarjetas.lista');
    }

    public function formularioVista()
    {
        return view('tarjetas.formulario');
    }

    public function crearTarjeta(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'descripcion.required' => 'El campo descripcion es obligatorio.',
        ]);

        // Crear una nueva tarjeta con Eloquent
        $tarjeta = Tarjetas::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion, // Corregido 'apellido' por 'descripcion'
        ]);

        // Redirigir a la ruta con un mensaje de éxito
        return redirect()->route('tarjetas')->with('success', 'Tarjeta creada correctamente');

    }

    public function tarjetasVista(Request $request){
        // Obtener todas las tarjetas ordenadas por nombre descendente con paginación
        $tarjetas = Tarjetas::orderBy('nombre', 'desc')->paginate(5);
        
        // Devolver la vista con las tarjetas paginadas
        return view('tarjetas.lista', compact('tarjetas'));
    }
    

    public function actualizarTarjeta(Request $request, $id){
        $tarjetas = Tarjetas::where('id',$id);
        $tarjetas ->update([
        'nombre'=>$request->nombre,
        'descripcion'=>$request->descripcion
        ]);
        return redirect()->route('tarjetas')->with('success', 'Cliente actualizado correctamente');
    }//eliminarTarjeta

    public function eliminarTarjeta($id){
        // Buscar la tarjeta por su ID
        $tarjeta = Tarjetas::find($id);

        // Validar si la tarjeta existe
        if (!$tarjeta) {
            return redirect()->route('tarjetas')->with('error', 'Tarjeta no encontrada.');
        }

        // Eliminar la tarjeta
        $tarjeta->delete();

        // Redirigir a la lista de tarjetas con un mensaje de éxito
        return redirect()->route('tarjetas')->with('success', 'Tarjeta eliminada correctamente.');
    }

}
