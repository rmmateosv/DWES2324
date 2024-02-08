<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Pedido_Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDOException;

class PedidosC extends Controller
{
    //Comprobar que hay usuario logueado
    function __construct()
    {
        $this->middleware('auth');
    }
    //
    function pedidos(){
        if(Auth::user()->tipo=='A'){
            $pedidos = Pedido::all();
            //Vista admin
            return view('pedidos/pedidos',compact('pedidos'));
        }
        else{
            //Recuperar el cliente asociado al usuario
            //HAcer un select: 
            //select * from clientes where user_id=Auth::users->id limit 1
            $cliente = Cliente::where('user_id',Auth::user()->id)->first();
            //Recuperar sus pedidos
            //HAcemos un select * from pedidos where cliente_id = idClienteLogueado
            $pedidos = Pedido::where('cliente_id',$cliente->id)->get();
            //Vista cliente
            return view('pedidos/pedidosC',compact('pedidos'));
        }
    }
    function crearPedido(){
        if(session('carrito')==null or sizeof(session('carrito'))==0){
            return back()->with('mensaje','Error no hay productos en el carrtio');
        }
        $error=false;
        try{
            //Creamos el pedido en una transacción
            //ya que hay que hacer inserts en 2 tablas: pedidos y pedido_productos
            DB::transaction(function () {
                //Crear el pedido a partir del variable de sesión
                //y del usuario logueado
                $p = new Pedido();
                $p->fecha=date('YmdHis');
                //Recuperamos el cliente
                $c = Cliente::where('user_id',Auth::user()->id)->first();
                $p->cliente_id=$c->id;
                if($p->save()){
                    //Crear una pedido_producto para cada producto
                    //que haya en el carrito
                    $carrito = session('carrito');
                    foreach($carrito as $pc){
                        $nuevo = new Pedido_Producto();
                        $nuevo->cantidad = $pc['cantidad'];
                        $nuevo->precioU = $pc['producto']->precio;
                        $nuevo->pedido_id=$p->id;
                        $nuevo->producto = $pc['producto']->id;
                        $nuevo->save();
                    }
                    
                }
        });
        }
        catch(PDOException $e){
            $error=true;
            return back()->with('mensaje','Error no se ha creado el pedido'.$e->getMessage());
        }
        finally{
            if(!$error){
                //Eliminar el carrito de la sessión
                session()->forget('carrito');
                return redirect()->route('pedidos')
                ->with('mensaje','Pedido creado');
            }
        }        
    }
}
