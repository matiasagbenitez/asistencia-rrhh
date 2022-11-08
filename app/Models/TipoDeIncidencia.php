<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeIncidencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    protected $table = 'tipos_de_incidencia';

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'tipo_de_incidencia_id', 'id');
    }
}
