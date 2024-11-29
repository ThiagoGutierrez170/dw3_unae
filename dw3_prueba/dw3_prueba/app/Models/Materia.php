<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $table='materias';//nombre de la tabla 
    //definir los campos 
    protected $fillable=[
        'nombre',
        'nro_materia',
        'acta',
        'estado',
        'semestre',
        'curso',
        'anho',
        'docente',
        'horas'
    ];
}
