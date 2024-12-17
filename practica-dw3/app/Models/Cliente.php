<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'apellido',
        'documento',
        'direccion',
        'telefono'
    ];

    // Relación: Un cliente puede tener muchos préstamos
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'id_cliente');
    }
}
