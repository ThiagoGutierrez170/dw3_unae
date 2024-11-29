<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\materiaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inicio', [materiaController::class, 'MateriasVista'])->name('inicio');
Route::get('/formulario', [materiaController::class, 'formularioVista']);
Route::post('/crearMateria', [materiaController::class, 'crearMateria']);
Route::post('/actualizarMateria/{id}', [materiaController::class, 'actualizarMateria']);
Route::delete('/eliminarMateria/{id}', [materiaController::class, 'eliminarMateria'])->name('eliminarMateria');

