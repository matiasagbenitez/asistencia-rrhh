<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'dia',
        'tipo',
        'hora_entrada',
        'hora_salida',
        'tolerancia',
        'categoria_de_horario_id',
    ];

    public function categoriaDeHorario()
    {
        return $this->belongsTo(CategoriasDeHorarios::class, 'categoria_de_horario_id', 'id');
    }
}
