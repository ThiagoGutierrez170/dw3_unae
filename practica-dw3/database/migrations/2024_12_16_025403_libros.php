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
        Schema::create('libros',function(Blueprint $table){
            $table->id();
            $table->string('titulo',200);
            $table->string('editorial');
            $table->enum('estado', ['disponible', 'no disponible'])->default('disponible');
            $table->unsignedBigInteger('id_autores');
            $table->foreign('id_autores')->references('id')->on('autores');
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
