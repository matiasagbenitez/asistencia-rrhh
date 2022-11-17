<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Empleado;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\Factories\Factory;

class AsistenciaFactory extends Factory
{
    // Variable que mantenga su valor entre llamadas
    protected static $empleado_id = 1;
    protected static $asistencias_count = 0;

    public function definition()
    {
        // Obtener el empleado con el id más bajo
        $empleado = Empleado::find(1);


        // Add 1 to the asistencias count
        // self::$asistencias_count++;
        // if (self::$asistencias_count > 50) {
        //     self::$empleado_id++;
        //     self::$asistencias_count = 1;
        //     return;
        // }

        if (!$empleado->asistencias) {

            $fecha_hora_entrada = Date::create(2022, 10, 3, 8, 0, 0);
            $fecha_hora_salida = Date::create(2022, 10, 3, 12, 0, 0);

        } else {

            if (rand(0, 1)) {
                $ultima_hora_salida = Asistencia::where('empleado_id', $empleado->id)->latest()->first()->fecha_hora_salida;
            } else {
                $ultima_hora_salida = Asistencia::where('empleado_id', $empleado->id)->latest()->first()->fecha_hora_salida;
            }

            // Si la última hora de salida es a las 12:00, la siguiente será a las 20:00
            if ($ultima_hora_salida->format('H:i:s') == '12:00:00') {

                $fecha_hora_entrada = Date::parse($ultima_hora_salida)->setTime(16, 0, 0);
                $fecha_hora_salida = Date::parse($fecha_hora_entrada)->setTime(20, 0, 0);

            } else {

                if ($ultima_hora_salida->format('H:i:s') == '20:00:00') {
                    $fecha_hora_entrada = Date::parse($ultima_hora_salida)->addDays(1)->setTime(8, 0, 0);

                    // Si la fecha de entrada es domingo, la hora de entrada será a las 12:00 después de 2 días
                    if ($fecha_hora_entrada->format('N') == 7) {
                        $fecha_hora_entrada = Date::parse($ultima_hora_salida)->addDays(2)->setTime(8, 0, 0);
                    }
                    $fecha_hora_salida = Date::parse($fecha_hora_entrada)->setTime(12, 0, 0);
                }

            }
        }

        return [
            'empleado_id' => $empleado->id,
            'fecha_hora_entrada' => $fecha_hora_entrada,
            'fecha_hora_salida' => $fecha_hora_salida,
        ];
    }
}
