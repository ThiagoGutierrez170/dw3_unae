<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autores';

    protected $fillable = [
        'nombre',
        'apellido',
        'documento'
    ];

    // Relación: Un autor tiene muchos libros
    public function libros()
    {
        return $this->hasMany(Libro::class, 'id_autores');
    }
}
