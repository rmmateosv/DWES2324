<?php

use App\Http\Controllers\ProductoC;
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
})->name('inicio');

Route::controller(ProductoC::class)->group(function(){
    //Definir una ruta básica para ver todos los productos
    //Ruta para ver todos los productos
    Route::get('productos','productos')->name('productos');
    //Ruta básica
    //Definir ruta para crear un producto
    Route::get('productos/crear','crear')->name('crearProducto');
    //Definir una ruta con un pármetro
    //Ruta para ver un producto concreto, pasando el id
    Route::get('productos/{idP}','ver')->name('verP');
    //Definir una ruta con un párametro
    //Ruta para borrar un producto concreto, pasando el id
    Route::get('productos/borrar/{idP}','borrar')->name('borrarP');
    //Definir una ruta con un párametro
    //Ruta para modificar un producto concreto, pasando el id
    Route::get('productos/modificar/{idP}','modificar')->name('modificarP');
});









//Definir ruta con dos parámetros
Route::get('productos/modificar/{idP}/{unTexto}',function($idP,$texto){
    echo '<h1>'.$texto.'</h1>';
    echo 'Página para modificar el producto '.$idP;
});
//Definir ruta con dos parámetros uno de ellos opcional(unTexto)
Route::get('productos/opt/{idP}/{unTexto?}',function($idP,$texto=null){
    echo '<h1>'.$texto!=null?$texto:"".'</h1>';
    echo 'Página para ver como se define un parámetro opcional '.$idP;
});