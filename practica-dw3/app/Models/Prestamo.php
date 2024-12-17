<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $table = 'prestamos';

    protected $fillable = [
        'estado',
        'id_libro',
        'id_cliente'
    ];

    // Relación: Un préstamo pertenece a un libro
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'id_libro');
    }

    // Relación: Un préstamo pertenece a un cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
