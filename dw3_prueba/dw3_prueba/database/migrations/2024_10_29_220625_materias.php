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
        Schema::create ('materias', function (Blueprint $table){
            $table->id();
            $table->String('nombre', 100);
            $table->integer('nro_materia',6)->unique();
            $table->string('acta');
            $table->string('estado')->default('activo');
            $table->string('semestre');
            $table->string('curso');
            $table->date('anho');
            $table->string('docente');
            $table->string('horas');
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
