<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\inicioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inicio',[inicioController::class,'index']);
Route::post('/CrearCliente',[ClienteController::class,'CrearCliente']);
Route::get('/ver_clientes',[ClienteController::class,'ver_clientes'])->name('ver_clientes');
Route::get('/show_cliente/{id}',[ClienteController::class,'show_cliente']);
Route::get('/delete_cliente/{id}',[ClienteController::class,'delete_cliente']);
Route::get('/update_cliente',[ClienteController::class,'update_cliente']);
Route::get('/ver_formulario',[ClienteController::class,'ver_formulario']);
Route::put('/update_cliente/{id}',[ClienteController::class,'update_cliente'])->name('update_cliente');
Route::post('/desactivar/{id}',[ClienteController::class,'desactivar'])->name('desactivar');
Route::post('/activar/{id}',[ClienteController::class,'activar'])->name('activar');