<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Libro;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    // Mostrar el detalle de un préstamo
    public function prestamoVista($id)
    {
        // Obtener datos del préstamo, libro y cliente
        $prestamo = Prestamo::findOrFail($id);
        $libro = Libro::findOrFail($prestamo->id_libro);
        $cliente = Cliente::findOrFail($prestamo->id_cliente);

        // Pasar datos a la vista 'prestamos.detalle' (mejor opción)
        return view('prestamos.detalle', compact('prestamo', 'libro', 'cliente'));
    }

    // Lista de préstamos (filtrados opcionalmente por cliente)
    public function prestamosLista($cliente_id = null)
    {
        // Filtrar préstamos por cliente si se pasa el ID
        $prestamos = Prestamo::when($cliente_id, function ($query, $cliente_id) {
            return $query->where('id_cliente', $cliente_id);
        })
            ->orderBy('estado', 'asc') // Ordenar por estado
            ->paginate(5); // Paginación de resultados

        // Obtener lista de libros y clientes
        $libros = Libro::orderBy('titulo', 'asc')->get();
        $clientes = Cliente::orderBy('nombre', 'asc')->get();

        // Pasar datos a la vista 'prestamos.lista'
        return view('prestamos.lista', compact('prestamos', 'libros', 'clientes'));
    }

    // Crear un nuevo préstamo
    public function crearPrestamo(Request $request)
    {
        // Validación de datos
        $request->validate([
            'estado'      => 'required|string|max:255',
            'id_libro'    => 'required|exists:libros,id',
            'id_cliente'  => 'required|exists:clientes,id',
        ], [
            'estado.required'      => 'El campo estado es obligatorio.',
            'id_libro.required'    => 'El campo libro es obligatorio.',
            'id_libro.exists'      => 'El libro seleccionado no existe.',
            'id_cliente.required'  => 'El campo cliente es obligatorio.',
            'id_cliente.exists'    => 'El cliente seleccionado no existe.',
        ]);

        // Crear el préstamo en la base de datos
        Prestamo::create([
            'estado'     => $request->estado,
            'id_libro'   => $request->id_libro,
            'id_cliente' => $request->id_cliente,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('prestamos.lista')->with('success', 'Préstamo creado correctamente.');
    }

    // Actualizar un préstamo existente
    public function actualizarPrestamo(Request $request, $id)
    {
        $prestamo = Prestamo::findOrFail($id); // Obtener el préstamo

        // Validación de datos
        $request->validate([
            'estado'      => 'required|string|max:255',
            'id_libro'    => 'required|exists:libros,id',
            'id_cliente'  => 'required|exists:clientes,id',
        ]);

        // Actualizar los datos del préstamo
        $prestamo->update([
            'estado'     => $request->estado,
            'id_libro'   => $request->id_libro,
            'id_cliente' => $request->id_cliente,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('prestamos.lista')->with('success', 'Préstamo actualizado correctamente.');
    }

    // Eliminar un préstamo
    public function eliminarPrestamo($id)
    {
        $prestamo = Prestamo::findOrFail($id); // Obtener el préstamo

        // Eliminar el préstamo
        $prestamo->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('prestamos.lista')->with('success', 'Préstamo eliminado correctamente.');
    }
}
