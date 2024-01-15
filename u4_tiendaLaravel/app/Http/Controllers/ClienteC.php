<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteC extends Controller
{
    //Método que maneja la ruta clientes
    function clientes(){
        return view('clientes/clientes');
    }
    //Método que maneja la ruta crearcliente
    function crear(){
        return view('clientes/crear');
    }
    function insertar(){
        return 'Insertar cliente';
    }
    //Método que maneja la ruta verC
    function ver($idC){
        return 'Página para ver el cliente '.$idC;
    }
    //Método que maneja la ruta modificarC
    function modificar($idC){
        return 'Página para modificar el cliente '.$idC;
    }
    //Método que maneja la ruta borrarP
    function borrar($idP){
        return 'Página para borrar el cliente '.$idC;
    }
}
