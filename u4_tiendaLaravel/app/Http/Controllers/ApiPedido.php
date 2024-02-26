<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Pedido_Producto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class ApiPedido extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //Crea un pedido con un producto
        //Parámetros: idP, idC, cantidad,
        $request->validate([
            'idP'=>'required',
            'idC'=>'required',
            'cantidad'=>'required|gte:1',
        ]);
        $p = Producto::find($request->idP);
        if($p==null){
            return response()->json('Error, no existe el producto',500);
        }
        if($p->stock<$request->cantidad){
            return response()->json('Error, no hoy stock',500);
        }
        else{
            $cant=$request->cantidad;
        }
        $c = Cliente::find($request->idC);
        if($c==null){
            return response()->json('Error, no existe el cliente',500);
        }
        $error=false;
        $ped=null;
        try{
            //Creamos el pedido en una transacción
            //ya que hay que hacer inserts en 2 tablas: pedidos y pedido_productos
            DB::transaction(function () use ($p, $c,$cant,$ped) {
                //Crear el pedido a partir del variable de sesión
                //y del usuario logueado
                $ped = new Pedido();
                $ped->fecha=date('YmdHis');
                $ped->cliente_id=$c->id;
                if($ped->save()){
                    //Guardar producto en pedido
                    $nuevo = new Pedido_Producto();
                    $nuevo->cantidad = $cant;
                    $nuevo->precioU = $p->precio;
                    $nuevo->pedido_id=$ped->id;
                    $nuevo->producto = $p->id;
                    $nuevo->save();                   
                }
        });
        }
        catch(PDOException $e){
            $error=true;
            return response()->json($e->getMessage(),500); 
        }
        finally{
           
        }        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    }
}
