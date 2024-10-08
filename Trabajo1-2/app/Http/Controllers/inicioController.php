<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inicioController extends Controller
{
    public function index(){
        $datos=[
            'mensaje'=>"Hola mundo!",
            'titulo'=>"Pagina bienvenida",
            'materias'=>['BD1','LP2','DW3','R1']
            
        ];
        //Formas de mostrar los datos
        //dd($datos);
        //return $datos; 
        //con compact
        return view('trabajos.index', $datos);
        //return view('trabajos.index',compact('datos'));
        //opcion con with
        //return view('trabajos.index')->with('mensaje',$mensaje);
    }
}
