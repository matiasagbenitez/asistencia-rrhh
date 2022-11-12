<?php

namespace App\Http\Services;

use App\Models\Empleado;
use App\Models\HoraExtra;
use App\Models\Incidencia;
use App\Models\TipoDeIncidencia;
use Carbon\Carbon;

class InformeService
{
    /**
     * Calcula las horas trabajadas de un empleado en un rango de fechas.
     * Sólo se tendrán en cuenta aquellas entradas y salidas con una diferencia menor o igual a 12 horas.
     *
     * @param Empleado $empleado
     * @param string $fechaInicio
     * @param string $fechaFin
     *
     * @return integer
     */
    public static function horasTrabajadas(Empleado $empleado, $fechaInicio, $fechaFin)
    {
        $entradas = Incidencia::where('tipo_de_incidencia_id', TipoDeIncidencia::ENTRADA)
            ->whereBetween('fecha_hora', [$fechaInicio, $fechaFin])
            ->where('empleado_id', $empleado->id)
            ->get();

        $total = 0;
        foreach ($entradas as $entrada) {
            $salida = Incidencia::where('tipo_de_incidencia_id', TipoDeIncidencia::SALIDA)
                ->where('fecha_hora', '>', $entrada->fecha_hora)
                ->where('empleado_id', $empleado->id)
                ->orderBy('fecha_hora', 'asc')
                ->first();

            if ($salida) {
                $inicio = Carbon::parse($entrada->fecha_hora);
                $fin = Carbon::parse($salida->fecha_hora);
                if ($inicio->diffInHours($fin) <= 12) {
                    $total += $inicio->diffInHours($fin);
                }
            }
        }

        return $total;
    }

    /**
     * Calcula las horas extras de un empleado en un rango de fechas.
     *
     * @param Empleado $empleado
     * @param string $fechaInicio
     * @param string $fechaFin
     *
     * @return integer
     */
    public static function horasExtras(Empleado $empleado, $fechaInicio, $fechaFin)
    {
        $horasExtras = HoraExtra::where('empleado_id', $empleado->id)
            ->whereBetween('fecha_hora_inicio', [$fechaInicio, $fechaFin])
            ->get();

        $total = 0;
        foreach ($horasExtras as $hora) {
            $inicio = Carbon::parse($hora->fecha_hora_inicio);
            $fin = Carbon::parse($hora->fecha_hora_fin);
            $total += $inicio->diffInHours($fin);
        }

        return $total;
    }
}
