<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoC extends Controller
{
    //Método que maneja la ruta productos
    function productos(){
        return 'Página para ver todos los productos';
    }
    //Método que maneja la ruta crearProducto
    function crear(){
        return 'Página para crear un producto';
    }
    //Método que maneja la ruta verP
    function ver($idP){
        return 'Página para ver el producto '.$idP;
    }
    //Método que maneja la ruta modificarP
    function modificar($idP){
        return 'Página para modificar el producto '.$idP;
    }
    //Método que maneja la ruta borrarP
    function borrar($idP){
        return 'Página para borrar el producto '.$idP;
    }

}
