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
        'puesto_id',
        'categoria_horario_id',
    ];

    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }

}
