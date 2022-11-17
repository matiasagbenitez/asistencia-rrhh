<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'cuil',
        'direccion',
        'fecha_ingreso',
        'fecha_egreso',
        'puesto_id',
        'categoria_horario_id',
    ];

    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
