<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //usar consultas de base de datos
use App\Models\Cliente;

class ClienteController extends Controller
{
    //
    public function ver_formulario(){
        return view('clientes.formulario');
    }
    public function CrearCliente(Request $request){

        //validacion
        $validacion = [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:22',
            'documento' => 'required|unique:clientes,documento|max:20',
            'telefono' => 'required|string|max:22',
            'direccion' => 'required|string|max:22',
        ];

        //mensaje personalizado
        $mensaje = [
            'nombre.required'=>'El campo nombre es obligatorio',
            'documento.unique'=>'El numero de documento ya esta registrado'
        ];
        //Validar datos
        $validar_datos= $request->validate($validacion, $mensaje);

        //Insertar datos en la tabla
        //utilizando eloquent

        $clientes = Cliente::all();
        $clientes = Cliente::create([
            'nombre'=>$request->nombre,
            'apellido'=>$request->apellido,
            'documento'=>$request->documento,
            'telefono'=>$request->telefono,
            'direccion'=>$request->direccion,
            'activo'=>$request->estado,
        ]);
        //Forma con SQL
        /*$clientes = DB::insert('insert into clientes (nombre, apellido, documento, telefono, direccion, activo) values (?,?,?,?,?,?)', [
            $nombre,
            $apellido,
            $documento,
            $telefono,
            $direccion,
            $activo
        ]);*/   
        return redirect()->route('ver_clientes')->with('success', 'Cliente creado correctamente');
    }

    public function desactivar($id){
        Cliente::where('id', $id)->update(['activo'=>0]);
        return redirect()->route('ver_clientes')->with('success', 'Cliente ha sido desactivado correctamente');
    }
    public function activar($id){
        Cliente::where('id', $id)->update(['activo'=>1]);
        return redirect()->route('ver_clientes')->with('success', 'Cliente ha sido activado correctamente');
    }
    public function ver_clientes(){
        //trae todos los datos
        //$clientes = Cliente::all();
        $clientes = Cliente::where('activo','!=', null)
        ->orderBy('nombre','desc')
        ->paginate(5);

        //trae datos en especifico
        //$clientes = Cliente::select('id','documento', 'nombre')->get();

        //filtrar por activos o por cualquier parametro que deseemos
        //$clientes = Cliente::where('activo', true)->get();

        //combinar las consultas anteriores
        /*$clientes = Cliente::select('id','documento', 'nombre', 'activo')
        ->where('activo', '!=', null) //coloca condiciones
        ->orderBy('documento', 'asc')
        ->get();*/

        return view('clientes.index',compact('clientes'));
    }

    //funcion para ver por ID
    public function show_cliente ($id){
        $cliente = Cliente::find($id);
        return response()->json(['message'=>'El cliente buscado es', 'cliente'=>$cliente]);
    }

    public function delete_cliente($id){
        $cliente = Cliente::find($id);
        if($cliente->activo == 0){
            $cliente->delete();
            return response()->json(['message'=>'Cliente eliminado correctamente']);
        }else{
            return response()->json(['message'=>'Cliente no eliminado']);
        };
    }
    public function update_cliente(Request $request, $id){
        $clientes = Cliente::where('id', $id);
        $clientes->update([
            'nombre'=>$request->nombre,
            'apellido'=>$request->apellido,
            'documento'=>$request->documento,
            'telefono'=>$request->telefono,
            'direccion'=>$request->direccion,
            'activo'=>$request->estado,
        ]);
        return redirect()->route('ver_clientes')->with('success', 'Cliente ha sido actualizado correctamente');
    }   
}
