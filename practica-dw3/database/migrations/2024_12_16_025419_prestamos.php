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
        Schema::create('prestamos',function(Blueprint $table){
            $table->id();
            $table->enum('estado', ['pendiente', 'devuelto', 'cancelado'])->default('pendiente');
            $table->unsignedBigInteger('id_libro');
            $table->foreign('id_libro')->references('id')->on('libros');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
