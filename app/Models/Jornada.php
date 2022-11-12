<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    use HasFactory;

    public const LUNES = 1;
    public const MARTES = 2;
    public const MIERCOLES = 3;
    public const JUEVES = 4;
    public const VIERNES = 5;
    public const SABADO = 6;
    public const DOMINGO = 7;

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
