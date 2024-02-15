<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;

class PrestamoC extends Controller
{
    //
    function ver(){
        //Obtener los préstamos de la BD
        $prestamos = Prestamo::all();
        //Cargar la vista
        return view('verP',compact('prestamos'));
    }
    function crear(){
        //Recuperar los libros
        $libros = Libro::all();
        //Cargar vista crear préstamo
        return view('crearP',compact('libros')); 
    }
    function modificar($id){
        
    }
    function insertar(Request $r){
        $r->validate([
            'fecha'=>'required',
            'libro'=>'required',
            'cliente'=>'required',
        ]);
    }
}
