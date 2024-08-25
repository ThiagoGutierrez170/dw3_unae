<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\productosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/CrearProducto',[productosController::class,'CrearProducto']);
Route::get('/VerProducto',[productosController::class,'ver_Productos']);
Route::get('/BuscarProducto/{id}',[productosController::class,'show_producto']);
Route::get('/EliminarProducto/{id}',[productosController::class,'delete_producto']);
Route::get('/updateProducto/{id}',[productosController::class, 'update_producto']);