<?php

use App\Http\Controllers\ApiLogin;
use App\Http\Controllers\ApiPedido;
use App\Http\Controllers\ApiProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'apiProductos' => ApiProducto::class,
    'apiLogin' => ApiLogin::class,
    'apiPedido' => ApiPedido::class
]);

//Crear ruta api para loguear a un cliente
Route::post('cliente',[ApiLogin::class,'login']);
