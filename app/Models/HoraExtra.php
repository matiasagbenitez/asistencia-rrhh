<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoraExtra extends Model
{
    use HasFactory;

    protected $table = 'horas_extras';
    protected $fillable = [
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'remuneracion',
        'empleado_id',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
}
