<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaNoLaborable extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'fecha',
    ];

    protected $table = 'dias_no_laborables';
}
