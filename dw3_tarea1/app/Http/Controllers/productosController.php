<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;
use DB;

class productosController extends Controller
{
    public function CrearProducto(){
        $nombre='fanta';
        $descripcion='fanta guarana';
        $codigo='12563';
        $marca='coca';
        $activo=false;
        $productos=producto::create([
            'nombre'=> $nombre,
            'descripcion'=> $descripcion,
            'codigo'=> $codigo,
            'marca' =>$marca,
            'activo'=> $activo,
        ]);
        return response()->json(['message'=>'producto creado correctamente', 'productos'=> $productos]);
    }
    public function ver_Productos(){
        $productos=producto::all();
        return response()->json(['productos.response', compact('productos')]);
    }
    public function show_producto($id){
        $productos=producto::find($id);
        return response()->json(['message'=>'lista creado correctamente', 'producto'=> $productos]);
    }
    public function delete_producto($id){
        $productos= producto::find($id);
        if($productos){
            $productos->delete();
            return response()->json(['message'=>'producto eliminado correctamente']);
        }else{
            return response()->json(['message'=>'producto no eliminado',404]);
        }
    }
    public function update_producto($id){
        $productos= producto::where('id',$id)
        ->first();
        $nombre='fanta';
        $descripcion='fanta piña';
        $codigo='125263';
        $marca='coca';
        $activo=false;
        $productos->update([
            'nombre'=> $nombre,
            'descripcion'=> $descripcion,
            'codigo'=> $codigo,
            'marca' =>$marca,
            'activo'=> $activo
        ]);
        return response()->json(['message'=>'producto actualizado correctamente', 'productos'=> $productos]);
    }
}