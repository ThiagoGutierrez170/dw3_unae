<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Mostrar la lista paginada de clientes
    public function clientesLista()
    {
        $clientes = Cliente::orderBy('nombre', 'asc')->paginate(5); // Ordenar por nombre y paginar resultados
        return view('clientes.lista', compact('clientes')); // Pasar a la vista clientes.lista
    }

    // Mostrar el detalle de un cliente específico
    public function clienteVista($id)
    {
        $cliente = Cliente::findOrFail($id); // Buscar cliente o devolver 404
        return view('clientes.detalle', compact('cliente')); // Pasar datos a la vista detalle
    }

    // Crear un nuevo cliente
    public function crearCliente(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'apellido'  => 'required|string|max:255',
            'documento' => 'required|string|max:255|unique:clientes,documento',
            'direccion' => 'required|string|max:255',
            'telefono'  => 'required|string|max:255',
        ], [
            'nombre.required'    => 'El campo nombre es obligatorio.',
            'apellido.required'  => 'El campo apellido es obligatorio.',
            'documento.required' => 'El campo documento es obligatorio.',
            'documento.unique'   => 'Este documento ya existe en el sistema.',
            'direccion.required' => 'El campo direccion es obligatorio.',
            'telefono.required'  => 'El campo telefono es obligatorio.',
        ]);

        // Crear cliente con los datos validados
        Cliente::create($request->all()); // Usar all() es correcto, pero puedes especificar campos si lo prefieres

        // Redirigir con mensaje de éxito
        return redirect()->route('clientes.lista')->with('success', 'Cliente creado correctamente.');
    }

    // Actualizar un cliente existente
    public function actualizarCliente(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id); // Buscar cliente por ID o devolver 404

        // Validación de datos
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'apellido'  => 'required|string|max:255',
            'documento' => "required|string|max:255|unique:clientes,documento,$id", // Excluir el documento del cliente actual
            'direccion' => 'required|string|max:255',
            'telefono'  => 'required|string|max:255',
        ], [
            'nombre.required'    => 'El campo nombre es obligatorio.',
            'apellido.required'  => 'El campo apellido es obligatorio.',
            'documento.required' => 'El campo documento es obligatorio.',
            'documento.unique'   => 'Este documento ya existe en el sistema.',
            'direccion.required' => 'El campo direccion es obligatorio.',
            'telefono.required'  => 'El campo telefono es obligatorio.',
        ]);

        // Actualizar cliente con los datos validados
        $cliente->update($request->all()); // Usar all() es correcto, pero especifica los campos si es necesario

        // Redirigir con mensaje de éxito
        return redirect()->route('clientes.lista')->with('success', 'Cliente actualizado correctamente.');
    }

    // Eliminar un cliente
    public function eliminarCliente($id)
    {
        $cliente = Cliente::findOrFail($id); // Buscar cliente por ID o devolver 404

        $cliente->delete(); // Eliminar el cliente

        // Redirigir con mensaje de éxito
        return redirect()->route('clientes.lista')->with('success', 'Cliente eliminado correctamente.');
    }
}
