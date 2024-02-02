<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDOException;

class LoginC extends Controller
{
    //
    function login(){
        //Carga la vista de login
        return view('login/loguear');
    }
    function registro(){
        //Carga la vista de resgistro
        return view('login/registrar');
    }
    function salir(){
        //Cerrar sesión y redirigir a login
        Auth::logout();
        return redirect()->route('login');
    }
    function loguear(Request $r){
        //Abrir sesión si us y ps son correctos
        $r->validate([
            'email'=>'required|email:rfc,dns',
            'ps'=>'required'
        ]);
        $credenciales = ['email'=>$r->email,
            'password'=>$r->ps];
        if(Auth::attempt($credenciales)){
            $r->session()->regenerate();
            return redirect()->route('productos');
        }
        else{
            return redirect()->back()->with('mensaje','Datos incorrectos');
        }

    }
    function registrar(Request $request){
        //Crear un usuario en users y clientes
        //Validaciones
        $request->validate([
            'nombre'=>'required|string', //Requerido y formato string
            //Email, requerido formato email y no se puede repetir 
            //con email de otro usuario
            'email'=>'required|string|email|unique:App\Models\User,email',
            'ps1'=>'required',
            'ps2'=>'required|same:ps1', //Requerida e igual a ps1
            'telf'=>'required',
            'dir'=>'required'

        ]);
        $error=false;
        try{
            DB::transaction(function() use ($request){
                //Crear usuario en tabla users
                $u = new User();
                $u->name=$request->nombre;
                $u->email=$request->email;
                $u->password=Hash::make($request->ps1);
                $u->tipo = 'C';
                if($u->save()){
                    //Crear el cliente 
                    $c = new Cliente();
                    $c->telefono=$request->telf;
                    $c->direccion=$request->dir;
                    $c->user_id = $u->id;
                    if($c->save()){
                        //Logueamos el usario directamente
                        Auth::login($u);
                        
                    }
                    else{
                        return back()->with('mensaje','Error al crear el cliente');
                    }
    
                }else{
                    return back()->with('mensaje','Error al crear el usuario');
                }
            });
        }
        catch(PDOException $e){
            $error=true;
            return back()->with('mensaje',$e->getMessage());
        } 
        finally{
            if(!$error){
                return redirect()->route('productos');
            }
            
        }
    }
}
