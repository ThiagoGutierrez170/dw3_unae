<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tarjetas extends Model
{
    use HasFactory;
    protected $table='tarjetas';//nombre de la tabla 
    //definir los campos 
    protected $fillable=[
        'nombre',
        'descripcion'
    ];
}
