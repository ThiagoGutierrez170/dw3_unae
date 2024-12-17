<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    // Mostrar la lista de autores
    public function index()
    {
        $autores = Autor::paginate(10);
        return view('autores.lista', compact('autores'));
    }

    // Mostrar el detalle de un autor
    public function show($id)
    {
        // Obtener autor por ID
        $autor = Autor::findOrFail($id);

        // Obtener los libros del autor
        $libros = Libro::where('id_autores', $id)->paginate(5);

        // Devolver vista con el autor y los libros
        return view('autores.detalle', compact('autor', 'libros'));
    }

    // Mostrar el formulario de creación de autor
    public function create()
    {
        return view('autores.create');
    }

    // Guardar un nuevo autor
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'documento' => 'required|string|max:255',
        ]);

        Autor::create($request->all());

        return redirect()->route('autores.index')->with('success', 'Autor creado correctamente.');
    }

    // Mostrar el formulario de edición de autor
    public function edit($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.edit', compact('autor'));
    }

    // Actualizar un autor
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'documento' => 'required|string|max:255',
        ]);

        $autor = Autor::findOrFail($id);
        $autor->update($request->all());

        return redirect()->route('autores.index')->with('success', 'Autor actualizado correctamente.');
    }

    // Eliminar un autor
    public function destroy($id)
    {
        $autor = Autor::findOrFail($id);
        $autor->delete();

        return redirect()->route('autores.index')->with('success', 'Autor eliminado correctamente.');
    }
}

