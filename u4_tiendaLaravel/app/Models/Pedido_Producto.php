<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido_Producto extends Model
{
    use HasFactory;
    
    //Indicar el nombre de la tablas cuando 
    //cuando no seguimos la convención de nombres
    protected $table = 'pedido_productos';

    function pedido(){
        //Si seguimos la convención de nombres
        return $this->belongsTo(Pedido::class);
        
    }
    function producto(){
        //Si NO seguimos la convención de nombres
        return $this->belongsTo(Producto::class, 'producto','id');
        
    }
}
