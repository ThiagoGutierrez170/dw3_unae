<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;
    protected $table='productos';//nombre de la tabla 
    //definir los campos 
    protected $fillable=[
        'nombre',
        'descripcion',
        'codigo',
        'marca',
        'activo',
    ];
}
