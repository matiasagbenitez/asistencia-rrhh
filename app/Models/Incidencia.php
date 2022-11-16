<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $table = 'incidencias';

    protected $fillable = [
        'empleado_id',
        'tipo_de_incidencia_id',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'descripcion',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }

    public function tipoDeIncidencia()
    {
        return $this->belongsTo(TipoDeIncidencia::class, 'tipo_de_incidencia_id', 'id');
    }
}
