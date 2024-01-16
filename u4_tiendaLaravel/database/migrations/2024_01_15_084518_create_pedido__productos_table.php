<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedido_productos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('cantidad');
            $table->float('precioU');
            //FK convencion de nombres Laravel
            $table->foreignId('pedido_id')->constrained()->
                onDelete('restrict')->onUpdate('cascade');
            //FK SIN convencion de nombres Laravel
            $table->unsignedBigInteger('producto');
            $table->foreign('producto')->references('id')
            ->on('productos')->onDelete('restrict')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_productos');
    }
};
