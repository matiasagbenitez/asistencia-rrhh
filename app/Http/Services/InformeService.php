<?php

namespace App\Http\Services;

use App\Models\Empleado;
use App\Models\HoraExtra;

class InformeService
{
    public static function horasExtras(Empleado $empleado, $fechaInicio, $fechaFin)
    {
        $horasExtras = HoraExtra::where('empleado_id', $empleado->id)
            ->whereBetween('fecha_hora_inicio', [$fechaInicio, $fechaFin])
            ->get();

        return $horasExtras;
    }
}
