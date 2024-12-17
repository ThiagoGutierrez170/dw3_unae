<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Libro;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    // Mostrar lista de préstamos
    public function prestamosLista()
    {
        $prestamos = Prestamo::with('libro', 'cliente')->paginate(10);
        return view('prestamos.lista', compact('prestamos'));
    }

    // Mostrar detalles de un préstamo específico
    public function prestamoVista($id)
    {
        $prestamo = Prestamo::with('libro', 'cliente')->findOrFail($id);
        return view('prestamos.detalle', compact('prestamo'));
    }

    // Crear un nuevo préstamo
    public function crearPrestamo(Request $request)
    {
        // Validación de datos
        $request->validate([
            'id_libro'    => 'required|exists:libros,id',
            'id_cliente'  => 'required|exists:clientes,id',
        ], [
            'id_libro.required'    => 'El campo libro es obligatorio.',
            'id_libro.exists'      => 'El libro seleccionado no existe.',
            'id_cliente.required'  => 'El campo cliente es obligatorio.',
            'id_cliente.exists'    => 'El cliente seleccionado no existe.',
        ]);

        // Verificar si el libro está disponible
        $libro = Libro::findOrFail($request->id_libro);
        if ($libro->estado !== 'disponible') {
            return redirect()->back()->withErrors('El libro no está disponible para préstamo.');
        }

        // Actualizar estado del libro a "no disponible"
        $libro->update(['estado' => 'no disponible']);

        // Crear el préstamo
        Prestamo::create([
            'estado'     => 'pendiente', // Por defecto
            'id_libro'   => $request->id_libro,
            'id_cliente' => $request->id_cliente,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('cliente.vista', $request->id_cliente)
                         ->with('success', 'Préstamo creado correctamente.');
    }

    // Actualizar un préstamo existente
    public function actualizarPrestamo(Request $request, $id)
    {
        $prestamo = Prestamo::findOrFail($id);

        // Validar el estado
        $request->validate([
            'estado' => 'required|in:devuelto,cancelado',
        ]);

        if ($prestamo->estado !== 'pendiente') {
            return redirect()->back()->withErrors('Este préstamo ya no se puede editar.');
        }

        // Actualizar el estado del préstamo
        $prestamo->update(['estado' => $request->estado]);

        // Actualizar el estado del libro a "disponible" si el préstamo se cierra
        if (in_array($request->estado, ['devuelto', 'cancelado'])) {
            $libro = Libro::findOrFail($prestamo->id_libro);
            $libro->update(['estado' => 'disponible']);
        }

        return redirect()->back()->with('success', 'Estado del préstamo actualizado correctamente.');
    }

    // Eliminar un préstamo
    public function eliminarPrestamo($id)
    {
        $prestamo = Prestamo::findOrFail($id);

        // Verificar si el préstamo está pendiente
        if ($prestamo->estado === 'pendiente') {
            // Actualizar estado del libro a "disponible"
            $libro = Libro::findOrFail($prestamo->id_libro);
            $libro->update(['estado' => 'disponible']);
        }

        // Eliminar el préstamo
        $prestamo->delete();

        return redirect()->back()->with('success', 'Préstamo eliminado correctamente.');
    }
}
