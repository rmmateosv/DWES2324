<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    function detalle(){
        return $this->hasMany(Pedido_Producto::class)->get();
    }
}
