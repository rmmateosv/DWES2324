<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteC extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    
    //Método que maneja la ruta clientes
    function clientes(){
        $clientes = Cliente::all();
        return view('clientes/clientes',compact('clientes'));
    }
    /*
    //Método que maneja la ruta crearcliente
    function crear(){
        return view('clientes/crear');
    }
    function insertar(Request $r){
        $r->validate([
            "nombre"=>"required", 
            "email"=>"required|unique:App\Models\Cliente,email|email:rfc,dns",
            "telefono"=>"required|size:9", 
            "direccion"=>"required"
        ]);


       //Crear un objeto del modelo Producto
       $c = new Cliente();
       //Rellenar los datos del producto
       //a partir de los campos del formulario
       $c->nombre = $r->nombre;
       $c->email = $r->email;
       $c->telefono = $r->telefono;
       $c->direccion= $r->direccion;
       if($c->save()){
            //Volvemos a la página anterior(ruta productos) y mostramos
            //mensaje de éxito
            return redirect()->route('clientes')->with('mensaje','Cliente creado con id '.$c->id);
       }
       else{
            //Volvemos a la página anterior(ruta productos) y mostramos
            //mensaje de error
            return back()->with('mensaje','Error al crear el cliente');
       }
    }*/
    //Método que maneja la ruta verC
    function ver($idC){
        return 'Página para ver el cliente '.$idC;
    }
    //Método que maneja la ruta modificarC
    function modificar($idC){
        //Recuperar los datos del cliente
        $c = Cliente::find($idC);
        return view('clientes/modificar',compact('c'));
    }
    //Método que maneja la ruta modificarP
    function actualizar(Request $r,$idC){
        //Validar: Admite un array con todas las validaciones
        //Hay que indicar el name del campo del campo a validar
        //y las validaciones sobre él. Si hay más de una se separan por |
        $r->validate([
            "nombre"=>"required", 
            "email"=>"required|email:rfc,dns",
            "telefono"=>"required|size:9", 
            "direccion"=>"required"
        ]);

        //Recuperar los datos del producto antes de modificar
        //es el producto tal cual está en la BD
        $c = Cliente::find($idC);
        //¡¡ VALIDAR SI SE HA CAMBIADO EL email
        //QUE NO ESTÉ REPETIDO!!
        if($c->usuario->email != $r->email){
            $r->validate(['email'=>'unique:App\Models\User,email']);
        }

        $c->usuario->name = $r->nombre;
        $c->usuario->email = $r->email;
        $c->telefono = $r->telefono;
        $c->direccion= $r->direccion;
        $error = false;
        try {
            DB::transaction(function() use ($c){
                if($c->save()){
                    if(!$c->usuario->save()){
                     return back()->with('mensaje','Error, no se ha modificado el cliente');
                    }
                 }
                 else{
                     return back()->with('mensaje','Error, no se ha modificado el cliente');
                 }});
        } catch (Exception $e) {
            $error=true;
            return back()->with('mensaje','Error, no se ha modificado el cliente');
        }
        finally{
            if(!$error){
                return redirect()->route('clientes')->with('mensaje','Cliente modificado correctamente');
            }
        }
        
    }
     
    //Método que maneja la ruta borrarP
    function borrar($idC){
        //Obtener el producto a borrar
        $c = Cliente::find($idC);

        //Si tiene pedidos no podemos borrar el productos
        if(sizeof($c->pedidos())>0){
            return back()->with('mensaje', 'Error, el cliente tiene pedidos');
        }
        else{
            $error = false;
            try {
                DB::transaction(function() use ($c){                    
                    if($c->delete()){
                        if(!$c->usuario->delete()){
                         return back()->with('mensaje','Error, no se ha borrado el usuario');
                        }
                     }
                     else{
                         return back()->with('mensaje','Error, no se ha borrado el cliente');
                     }
                });
            } catch (Exception $e) {
                $error=true;
                return back()->with('mensaje','Error, no se ha borrado el cliente');
            }
            finally{
                if(!$error){
                    return redirect()->route('clientes')->with('mensaje','Cliente borrado correctamente');
                }
            }

            
        }
    }
}

