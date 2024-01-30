<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    function pedidos(){
        //Si no seguimos la convención de nombres
        //return $this->HasMany(Pedido::class,'cliente_id','id')->get();
        
        //Si seguimos la convención de nombres
        return $this->HasMany(Pedido::class)->get();
    }
    function usuario(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
