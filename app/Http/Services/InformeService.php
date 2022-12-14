<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\Jornada;
use App\Models\Empleado;
use App\Models\HoraExtra;
use App\Models\Asistencia;
use App\Models\Incidencia;
use App\Models\TipoDeIncidencia;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            // $inicio = Carbon::parse($asistencia->fecha_hora_entrada);
            // $fin = Carbon::parse($asistencia->fecha_hora_salida);
            // $total += $inicio->diffInHours($fin);
            $total += $asistencia->cantidad_horas;
        }

        return $total;
    }

    /**
     * Calcula la cantidad de horas que debería trabajar un empleado entre un rango de fechas.
     *
     * @param Empleado $empleado
     * @param string $fechaInicio
     * @param string $fechaFin
     *
     * @return integer
     */
    public static function cantidadHorasHorario(Empleado $empleado, $fechaInicio, $fechaFin)
    {
        $inicio = Carbon::parse($fechaInicio);
        $fin    = Carbon::parse($fechaFin);
        $horario = self::horario($empleado);
        $total = 0;
        while ($inicio <= $fin) {
            if ($horario['horas'][$inicio->dayOfWeek]) {
                $total += $horario['horas'][$inicio->dayOfWeek];
            }
            $inicio->addDay();
        }

        return $total;
    }

    /**
     * Devuelve una colección de todas las asistencias de un empleado entre un rango de fechas.
     *
     * @param Empleado $empleado
     * @param string $fechaInicio
     * @param string $fechaFin
     *
     * @return Collection
     */
    public static function listadoAsistencias(Empleado $empleado, $fechaInicio, $fechaFin)
    {
        $asistencias = Asistencia::where('empleado_id', $empleado->id)
            ->whereBetween('fecha_hora_entrada', [$fechaInicio, $fechaFin])
            ->get();

        $incidencias = Incidencia::where('empleado_id', $empleado->id)
            ->whereBetween('fecha_hora_inicio', [$fechaInicio, $fechaFin])
            ->orderBy('fecha_hora_inicio')->get();

        $lista = [];
        foreach ($asistencias as $asistencia) {
            $lista[] = [
                'fecha_hora_entrada' => $asistencia->fecha_hora_entrada,
                'fecha_hora_fin' => $asistencia->fecha_hora_salida,
                'tipo' => 'asistencia',
            ];
        }

        foreach ($incidencias as $incidencia) {
            $lista[] = [
                'fecha_hora_entrada' => $incidencia->fecha_hora_inicio,
                'fecha_hora_fin' => $incidencia->fecha_hora_fin,
                'tipo' => $incidencia->tipoDeIncidencia->nombre,
            ];
        }

        usort($lista, function ($a, $b) {
            return $a['fecha_hora_entrada'] <=> $b['fecha_hora_entrada'];
        });

        return $lista;
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
            // $inicio = Carbon::parse($hora->fecha_hora_inicio);
            // $fin = Carbon::parse($hora->fecha_hora_fin);
            // $total += $inicio->diffInHours($fin);

            // Simplificando la lógica anterior
            $total += $hora->cantidad_horas;
        }

        return $total;
    }

    /**
     * Devuelve una colección de todas las horas extras de un empleado entre un rango de fechas.
     *
     * @param Empleado $empleado
     * @param string $fechaInicio
     * @param string $fechaFin
     *
     * @return integer
     */
    public static function listadoHorasExtra(Empleado $empleado, $fechaInicio, $fechaFin)
    {
        return HoraExtra::where('empleado_id', $empleado->id)
            ->whereBetween('fecha_hora_inicio', [$fechaInicio, $fechaFin])
            ->get();
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
     * Devuelve un array con las instancias de jornadas de un empleado y la cantidad de horas
     * de trabajo en cada dia de la semana según su categoría de horario.
     *
     * @param Empleado $empleado
     *
     * @return array
     */
    public static function horario(Empleado $empleado)
    {
        $horario = [
            Jornada::DOMINGO => [],
            Jornada::LUNES => [],
            Jornada::MARTES => [],
            Jornada::MIERCOLES => [],
            Jornada::JUEVES => [],
            Jornada::VIERNES => [],
            Jornada::SABADO => [],
        ];

        foreach ($horario as $key => $value) {
            $horario['instancias'][$key] = Jornada::where('categoria_de_horario_id', $empleado->categoria_horario_id)
                ->where('dia', $key)
                ->orderBy('hora_entrada', 'asc')
                ->get();
            $horario['horas'][$key] = DB::select("SELECT SUM(dif) as minutos FROM (
                SELECT TIMESTAMPDIFF(MINUTE, hora_entrada, hora_salida) as dif
                FROM jornadas
                WHERE categoria_de_horario_id = {$empleado->categoria_horario_id}
                AND dia = {$key}
            ) as t")[0]->minutos / 60;
        }

        return $horario;
    }

    /**
     * Calcula el exceso de horas según las diferencias entre horarios de jornada y de asistencias
     * de un empleado en un rango de fechas. (Calculado en minutos inicialmente)
     *
     * @param Empleado $empleado
     * @param string $fechaInicio
     * @param string $fechaFin
     *
     * @return array
     */
    public static function excesoHoras(Empleado $empleado, $fechaInicio, $fechaFin)
    {
        $horasTrabajadas = self::horasTrabajadas($empleado, $fechaInicio, $fechaFin);

        // Restar un dia a la fecha de fin
        $fechaFin = Carbon::parse($fechaFin)->subDay()->toDateString();

        $cantidadHorasHorario = self::cantidadHorasHorario($empleado, $fechaInicio, $fechaFin);

        return [
            'cantidadDeHoras' => $cantidadHorasHorario,
            'horasTrabajadas' => $horasTrabajadas,
            'exceso' => $horasTrabajadas - $cantidadHorasHorario
        ];
    }

    /**
     * Calcula los datos necesarios para generar los gráficos del informe
     *
     * @param Empleado $empleado
     * @param string $fechaInicio
     * @param string $fechaFin
     *
     * @return integer
     */
    public static function calcularGraficos(Empleado $empleado, $fechaInicio, $fechaFin)
    {
        for ($i = 1; $i <= 12; $i++) {
            $primerDia = date('Y-m-d', strtotime(date('Y') . '-' . $i . '-01'));
            $ultimoDia = date('Y-m-t', strtotime(date('Y') . '-' . $i . '-01'));
            $horasExtras[$i] = HoraExtra::where('empleado_id', $empleado->id)
                ->whereBetween('fecha_hora_inicio', [$primerDia, $ultimoDia])
                ->sum('cantidad_horas');
        }
        $horasExtrasPorMes = [
            'ENE' => $horasExtras[1],
            'FEB' => $horasExtras[2],
            'MAR' => $horasExtras[3],
            'ABR' => $horasExtras[4],
            'MAY' => $horasExtras[5],
            'JUN' => $horasExtras[6],
            'JUL' => $horasExtras[7],
            'AGO' => $horasExtras[8],
            'SEP' => $horasExtras[9],
            'OCT' => $horasExtras[10],
            'NOV' => $horasExtras[11],
            'DIC' => $horasExtras[12],
        ];

        return [
            'horasExtras' => $horasExtrasPorMes,
            'asistencias' => self::asistencias($empleado, $fechaInicio, $fechaFin),
            'faltasJustificadas' => self::faltasJustificadas($empleado, $fechaInicio, $fechaFin),
            'faltasInjustificadas' => self::faltasInjustificadas($empleado, $fechaInicio, $fechaFin),
        ];
    }
}
