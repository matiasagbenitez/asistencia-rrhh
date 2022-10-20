<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriasDeHorarios extends Model
{
    use HasFactory;

    protected $table = 'categorias_de_horarios';

    protected $fillable = [
        'nombre',
    ];

}
