<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiLogin extends Controller
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
        //
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
    public function login(Request $r){
        //Abrir sesión si us y ps son correctos
        $r->validate([
            'email'=>'required',
            'ps'=>'required'
        ]);
        $credenciales = ['email'=>$r->email,
            'password'=>$r->ps];
        if(Auth::attempt($credenciales)){
            //REcuperar el id del cliente a partir del Usuario logueado
            $cliente = Cliente::where('user_id',Auth::user()->id)->first();
            return new UserResource($cliente);
        }
        else{
            return abort('401');
        }
    }
}
