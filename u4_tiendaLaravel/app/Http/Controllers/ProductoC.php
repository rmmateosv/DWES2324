<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoC extends Controller
{
    //Método que maneja la ruta productos
    function productos(){
        //Recuperar los productos para mostrarlos en la
        //tabla de la vista productos
        $productos = Producto::all();
        return view('productos/productos',compact('productos'));
    }
    //Método que maneja la ruta crearProducto
    function crear(){
        return view('productos/crear');
    }
    //Esta método se llama desde el submit del formulario
    //Para acceder a los campos del formulario hay que
    //definir un parámetro de la clase Request
    function insertar(Request $r){
       //Crear un objeto del modelo Producto
       $p = new Producto();
       //Rellenar los datos del producto
       //a partir de los campos del formulario
       $p->nombre = $r->nombre;
       $p->descripcion = $r->desc;
       $p->precio = $r->precio;
       $p->stock= $r->stock;
       $p->img='nombreIMG';
       //Hacemos el insert en la tabla
       if($p->save()){
            //Volvemos a la página anterior(ruta productos) y mostramos
            //mensaje de éxito
            return redirect()->route('productos')->with('mensaje','Producto creado con id '.$p->id);
       }
       else{
            //Volvemos a la página anterior(ruta productos) y mostramos
            //mensaje de error
            return back()->with('mensaje','Error al crear el producto');
       }


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
