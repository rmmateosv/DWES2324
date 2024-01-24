<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteC extends Controller
{
    //Método que maneja la ruta clientes
    function clientes(){
        $clientes = Cliente::all();
        return view('clientes/clientes',compact('clientes'));
    }
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
    }
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
        if($c->email != $r->email){
            $r->validate(['email'=>'unique:App\Models\Cliente,email']);
        }

        $c->nombre = $r->nombre;
        $c->email = $r->email;
        $c->telefono = $r->telefono;
        $c->direccion= $r->direccion;
        if($c->save()){
            return redirect()->route('clientes')->with('mensaje','Cliente modificado correctamente');
        }
        else{
            return back()->with('mensaje','Error, no se ha modificado el cliente');
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
            if($c->delete()){
                return back()->with('mensaje', 'Cliente borrado'); 
            }
        }
    }
}

