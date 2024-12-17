<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $table = 'libros';

    protected $fillable = [
        'titulo',
        'editorial',
        'estado',
        'id_autores'
    ];

    // Relación: Un libro pertenece a un autor
    public function autor()
    {
        return $this->belongsTo(Autor::class, 'id_autores');
    }

    // Relación: Un libro puede estar en varios préstamos
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'id_libro');
    }
}
