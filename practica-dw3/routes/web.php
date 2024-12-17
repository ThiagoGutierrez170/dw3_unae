<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\autorController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\prestamoController;
use App\Http\Controllers\libroController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para el controlador de autores
// Mostrar la lista de autores
Route::get('/autores', [AutorController::class, 'index'])->name('autores.index');
// Mostrar el detalle de un autor
Route::get('/autores/{id}', [AutorController::class, 'show'])->name('autor.show');
// Mostrar el formulario para crear un nuevo autor
Route::get('/autores/create', [AutorController::class, 'create'])->name('autores.create');
// Crear un nuevo autor (se envía el formulario)
Route::post('/autores', [AutorController::class, 'store'])->name('autores.store');
// Mostrar el formulario de edición de un autor
Route::get('/autores/{id}/edit', [AutorController::class, 'edit'])->name('autores.edit');
// Actualizar un autor (se envía el formulario de edición)
Route::put('/autores/{id}', [AutorController::class, 'update'])->name('autores.update');
// Eliminar un autor
Route::delete('/autores/{id}', [AutorController::class, 'destroy'])->name('autores.destroy');


// Rutas para libros
Route::get('/libros', [LibroController::class, 'librosLista'])->name('libros.lista'); // Mostrar lista de libros
Route::get('/libros/{id}', [LibroController::class, 'libroVista'])->name('libro.vista'); // Mostrar detalle de un libro
Route::post('/libros', [LibroController::class, 'crearLibro'])->name('libros.crear'); // Crear nuevo libro
Route::put('/libros/{id}', [LibroController::class, 'actualizarLibro'])->name('libros.actualizar'); // Actualizar libro
Route::delete('/libros/{id}', [LibroController::class, 'eliminarLibro'])->name('libros.eliminar'); // Eliminar libro


// Ruta para ver libros por autor
Route::get('/libros/autor/{id}', [LibroController::class, 'librosPorAutor'])->name('libros.por_autor');

// Rutas para clientes
Route::get('/clientes', [ClienteController::class, 'clientesLista'])->name('clientes.lista');
Route::get('/clientes/{id}', [ClienteController::class, 'clienteVista'])->name('cliente.vista');
Route::post('/clientes', [ClienteController::class, 'crearCliente'])->name('clientes.crear');
Route::put('/clientes/{id}', [ClienteController::class, 'actualizarCliente'])->name('clientes.actualizar');
Route::delete('/clientes/{id}', [ClienteController::class, 'eliminarCliente'])->name('clientes.eliminar');

// Rutas para préstamos
Route::get('/prestamos', [PrestamoController::class, 'prestamosLista'])->name('prestamos.lista');
Route::get('/prestamos/{id}', [PrestamoController::class, 'prestamoVista'])->name('prestamo.vista');
Route::post('/prestamos', [PrestamoController::class, 'crearPrestamo'])->name('prestamos.crear');
Route::put('/prestamos/{id}', [PrestamoController::class, 'actualizarPrestamo'])->name('prestamos.actualizar');
Route::delete('/prestamos/{id}', [PrestamoController::class, 'eliminarPrestamo'])->name('prestamos.eliminar');

require __DIR__.'/auth.php';
