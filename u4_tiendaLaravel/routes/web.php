<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Definir una ruta básica para ver todos los productos
//Ruta para ver todos los productos
Route::get('productos',function(){
    echo 'Página para ver todos los productos';
});

//Ruta básica
//Definir ruta para crear un producto
Route::get('productos/crear',function(){
    echo 'Página para crear un producto';
});

//Definir una ruta con un pármetro
//Ruta para ver un producto concreto, pasando el id
Route::get('productos/{idP}',function($idP){
    echo 'Página para ver el producto '.$idP;
});

//Definir una ruta con un párametro
//Ruta para borrar un producto concreto, pasando el id
Route::get('productos/borrar/{idP}',function($idP){
    echo 'Página para borrar el producto '.$idP;
});
//Definir una ruta con un párametro
//Ruta para modificar un producto concreto, pasando el id
Route::get('productos/modificar/{idP}',function($idP){
    echo 'Página para modificar el producto '.$idP;
});

//Definir ruta con dos parámetros
Route::get('productos/modificar/{idP}/{unTexto}',function($idP,$texto){
    echo '<h1>'.$texto.'</h1>';
    echo 'Página para modificar el producto '.$idP;
});
