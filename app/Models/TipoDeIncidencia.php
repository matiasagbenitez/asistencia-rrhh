<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeIncidencia extends Model
{
    use HasFactory;

    public const SALIDA = 3;
    public const ENTRADA = 2;
    public const FALTA_INJUSTIFICADA = 4;
    public const FALTA_JUSTIFICADA = 5;

    protected $fillable = [
        'nombre',
        'descuenta_sueldo',
    ];

    protected $table = 'tipos_de_incidencia';

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'tipo_de_incidencia_id', 'id');
    }
}
