<?php

namespace App\Http\Services;

use App\Models\Asistencia;
use App\Models\Empleado;
use App\Models\HoraExtra;
use App\Models\Incidencia;
use App\Models\Jornada;
use App\Models\TipoDeIncidencia;
use Carbon\Carbon;

class InformeService
{
    /**
     * Calcula las horas trabajadas de un empleado en un rango de fechas.
     *
     * @param Empleado $empleado
     * @param string $fechaInicio
     * @param string $fechaFin
     *
     * @return integer
     */
    public static function horasTrabajadas(Empleado $empleado, $fechaInicio, $fechaFin)
    {
        $total = 0;
        $asistencias = Asistencia::where('empleado_id', $empleado->id)
            ->whereBetween('fecha_hora_entrada', [$fechaInicio, $fechaFin])
            ->get();

        foreach ($asistencias as $asistencia) {
            $inicio = Carbon::parse($asistencia->fecha_hora_entrada);
            $fin = Carbon::parse($asistencia->fecha_hora_salida);
            $total += $inicio->diffInHours($fin);
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

    /**
     * Calcula las faltas injustificadas de un empleado en un rango de fechas.
     *
     * @param Empleado $empleado
     * @param string $fechaInicio
     * @param string $fechaFin
     *
     * @return integer
     */
    public static function faltasInjustificadas(Empleado $empleado, $fechaInicio, $fechaFin)
    {
        $faltas = Incidencia::where('tipo_de_incidencia_id', TipoDeIncidencia::FALTA_INJUSTIFICADA)
            ->whereBetween('fecha_hora_inicio', [$fechaInicio, $fechaFin])
            ->where('empleado_id', $empleado->id)
            ->count();

        return $faltas;
    }

    /**
     * Calcula las faltas justificadas de un empleado en un rango de fechas.
     *
     * @param Empleado $empleado
     * @param string $fechaInicio
     * @param string $fechaFin
     *
     * @return integer
     */
    public static function faltasJustificadas(Empleado $empleado, $fechaInicio, $fechaFin)
    {
        $faltas = Incidencia::where('tipo_de_incidencia_id', TipoDeIncidencia::FALTA_JUSTIFICADA)
            ->whereBetween('fecha_hora_inicio', [$fechaInicio, $fechaFin])
            ->where('empleado_id', $empleado->id)
            ->count();

        return $faltas;
    }

    /**
     * Calcula las asistencias de un empleado en un rango de fechas.
     *
     * @param Empleado $empleado
     * @param string $fechaInicio
     * @param string $fechaFin
     *
     * @return integer
     */
    public static function asistencias(Empleado $empleado, $fechaInicio, $fechaFin)
    {
        $asistencias = Asistencia::where('empleado_id', $empleado->id)
            ->whereBetween('fecha_hora_entrada', [$fechaInicio, $fechaFin])
            ->count();

        return $asistencias;
    }

    /**
     * Devuelve un array con los horarios de jornadas de cada dia de un empleado según su categoría de horario.
     *
     * @param Empleado $empleado
     *
     * @return array
     */
    public static function horario(Empleado $empleado)
    {
        $horario = [
            Jornada::LUNES => [],
            Jornada::MARTES => [],
            Jornada::MIERCOLES => [],
            Jornada::JUEVES => [],
            Jornada::VIERNES => [],
            Jornada::SABADO => [],
            Jornada::DOMINGO => [],
        ];

        foreach ($horario as $key => $value) {
            $horario[$key] = Jornada::where('categoria_de_horario_id', $empleado->categoria_horario_id)
                ->where('dia', $key)
                ->orderBy('hora_entrada', 'asc')
                ->get();
        }

        return $horario;
    }
}
