<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cuit',
        'razon_social',
        'direccion',
    ];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
