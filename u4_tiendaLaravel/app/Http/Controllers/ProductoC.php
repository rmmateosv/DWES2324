<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        //Subir imagen del producto al servidor
        //y rellenar el producto con la ruta de la imagen
        //El fichero se almacena en storage/app/public/img/productos
        $ruta=$r->file('imagen')->store('img/productos','public');
       $p->img=$ruta;
       //Hacemos el insert en la tabla
       //$p->save:Sabe que hay que hacer un insert porque $p
       //se ha creado con un new. 
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
        //Recuperar los datos del producto
        $p = Producto::find($idP);
        return view('productos/modificar',compact('p'));
    }
    //Método que maneja la ruta modificarP
    function actualizar(Request $r,$idP){
        //Recuperar los datos del producto antes de modificar
        //es el producto tal cual está en la BD
        $p = Producto::find($idP);
        //Modificamos los campos que se hayan podido cambiar en el formulario
        //$r tiene los datos modificados y $p los antiguos
        $p->nombre = $r->nombre;
        $p->descripcion = $r->desc;
        $p->precio = $r->precio;
        $p->stock = $r->stock;

        //Subir nueva imagen solamente si se ha modficado
        if(!empty($r->imagen)){
            //Borrar la imagen antigua
            Storage::delete('public/'.$p->img);
            //Subir la imagen nueva
            $ruta = $r->file('imagen')->store('img/productos','public');
            $p->img=$ruta;
        }

        //Modificar el producto en la BD
        //$p->save:Sabe que hay que hacer un update porque $p
        //se ha creado con un find. 
        if($p->save()){
            return back()->with('mensaje','Producto modificado correctamente');
        }
        else{
            return back()->with('mensaje','Error, no se ha modificado el producto');
        }
       
    }
    //Método que maneja la ruta borrarP
    function borrar($idP){
        //Obtener el producto a borrar
        $p = Producto::find($idP);

        //Si tiene pedidos no podemos borrar el productos
        if(sizeof($p->detalle_pedidos())>0){
            return back()->with('mensaje', 'Error, el producto se ha pedido');
        }
        else{
            if($p->delete()){
                //Borrar la imagen
                Storage::delete('public/'.$p->img);
                return back()->with('mensaje', 'Producto borrado'); 
            }
        }
    }
    

}
