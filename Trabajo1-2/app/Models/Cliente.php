<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes'; //siempre va nombre de la tabla, tal cual como en la DB

    //definir los campos
    protected $fillable =[
        'nombre',
        'apellido',
        'documento',
        'telefono',
        'activo'
    ];
}
