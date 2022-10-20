<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'empresa_id',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function departamentos()
    {
        return $this->hasMany(Departamento::class);
    }
}
