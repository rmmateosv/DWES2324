<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoC extends Controller
{
    //
    function __construct()
    {
        $this->middleware('auth');
    }

    function insertarCarrito($idP){
        //Recuperar el producto
        $producto = Producto::find($idP);
       
        //El carrito se alamacena en una variable de sesión
        if(session('carrito')==null){
            //Crear la variabel de sessión carrtio
           session(['carrito'=>array()]);
        }
        //Comprobar si el producto está en el carrito
        $actualizado = false;
        foreach(session('carrito') as $pc){
            if($pc['producto']->id == $producto->id){
                $pc['cantidad']+=1;
                $actualizado = true;
            }
        }
        if(!$actualizado){
            //Añadir al carrito el producto
            //Cada elemento del carrrito es un array asociativo 
            //que contiene el producto y la cantidad;
            session('carrito')[]=array('producto'=>$producto,'cantidad'=>1);
        }
        

        session('carrito')[]=$producto;
    }
}
