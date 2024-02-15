<?php

namespace App\Http\Controllers;

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
        
    }
    function modificar($id){
        
    }
}
