<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ApiProducto extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Producto::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
                "nombre"=>"required|unique:App\Models\Producto,nombre", //Dos validaciones: requerido y único en la tabla productos
                "descripcion"=>"required",
                "precio"=>"required|gte:0", //Requerido y >=0
                "stock"=>"required|gte:0" //Requerido y >=0
            ]
        );
        $p = new Producto();
        $p->nombre=$request->nombre;
        $p->descripcion=$request->descripcion;
        $p->precio=$request->precio;
        $p->stock=$request->stock;
        $p->baja=false;
        $p->img='img/productos/logo.png';
        if(!$p->save()){
            return abort('Error al crear el producto',500);
        }
        else{
            return response()->json($p,201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Producto::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $p=Producto::find($id);
        if(!$p->delete()){
            abort(500);
        }
        else{
            return response()->noContent(); //204
        }
    }
}
