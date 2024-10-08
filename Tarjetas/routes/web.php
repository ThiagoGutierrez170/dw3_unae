<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tarjetaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inicio', [tarjetaController::class, 'tarjetasVista'])->name('tarjetas');
Route::get('/formulario', [tarjetaController::class, 'formularioVista']);
Route::post('/crearTarjeta', [tarjetaController::class, 'crearTarjeta']);
Route::post('/actualizarTarjeta/{id}', [tarjetaController::class, 'actualizarTarjeta']);
Route::delete('/eliminarTarjeta/{id}', [tarjetaController::class, 'eliminarTarjeta'])->name('eliminarTarjeta');

