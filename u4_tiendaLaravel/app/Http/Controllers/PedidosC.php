<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
