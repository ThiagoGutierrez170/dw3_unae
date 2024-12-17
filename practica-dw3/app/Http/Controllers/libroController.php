<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Autor;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    // Mostrar lista de libros
    public function librosLista()
{
    // Obtener los libros con paginación
    $libros = Libro::orderBy('titulo', 'asc')->paginate(5);

    // Obtener todos los autores
    $autores = Autor::all();

    // Pasar ambos datos a la vista
    return view('libros.lista', compact('libros', 'autores')); // Vista lista
}


    // Mostrar detalle de un libro específico
    public function libroVista($id)
    {
        // Buscar el libro o devolver 404 si no existe
        $libro = Libro::findOrFail($id);

        // Buscar el autor relacionado
        $autor = Autor::find($libro->id_autores); // Asumiendo relación 1 a 1

        // Devolver vista con los datos
        return view('libros.detalle', compact('libro', 'autor')); // Vista detalle
    }

    // Crear un nuevo libro
    public function crearLibro(Request $request)
    {
        // Validar datos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'editorial' => 'required|string|max:255',
            'id_autores' => 'required|exists:autores,id', // Validar si el autor existe
        ]);

        // Crear libro
        Libro::create([
            'titulo' => $request->titulo,
            'editorial' => $request->editorial,
            'id_autores' => $request->id_autores,
        ]);

        return redirect()->route('libros.lista')->with('success', 'Libro creado correctamente');
    }

    // Actualizar un libro existente
    public function actualizarLibro(Request $request, $id)
    {
        // Validar datos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'editorial' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'id_autores' => 'required|exists:autores,id', // Validar autor
        ]);

        // Buscar libro y actualizar
        $libro = Libro::findOrFail($id);
        $libro->update([
            'titulo' => $request->titulo,
            'editorial' => $request->editorial,
            'estado' => $request->estado,
            'id_autores' => $request->id_autores,
        ]);

        return redirect()->route('libros.lista')->with('success', 'Libro actualizado correctamente');
    }

    // Eliminar un libro
    public function eliminarLibro($id)
    {
        // Buscar el libro y eliminar
        $libro = Libro::findOrFail($id);
        $libro->delete();

        return redirect()->route('libros.lista')->with('success', 'Libro eliminado correctamente');
    }

    // Mostrar los libros de un autor específico
    public function librosPorAutor($id)
    {
        // Buscar autor o devolver 404
        $autor = Autor::findOrFail($id);

        // Obtener libros por autor
        $libros = Libro::where('id_autores', $id)->orderBy('titulo', 'asc')->paginate(5);

        return view('libros.por_autor', compact('autor', 'libros')); // Vista por autor
    }
    
}
