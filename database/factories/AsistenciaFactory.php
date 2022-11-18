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
        $empleado = Empleado::find(self::$empleado_id);

        self::$asistencias_count++;
        if (self::$asistencias_count >= 30) {
            self::$empleado_id++;
            self::$asistencias_count = 0;
        }

        // Obtener el último registro de asistencia del empleado
        $last_asistencia = Asistencia::where('empleado_id', $empleado->id)->orderBy('id', 'desc')->first();

        if ($last_asistencia) {
            $ultima_salida = Date::parse($last_asistencia->fecha_hora_salida);

            // Si la última hora de salida es a las 12:00, la siguiente entrada será a las 16:00
            if ($ultima_salida->format('H:i:s') == '12:00:00') {

                $fecha_hora_entrada = Date::parse($ultima_salida)->setTime(16, 0, 0);
                $fecha_hora_salida = Date::parse($fecha_hora_entrada)->setTime(20, 0, 0);

            } else {

                // Si la última hora de salida es a las 20:00, la siguiente entrada será al día siguiente a las 8:00
                if ($ultima_salida->format('H:i:s') == '20:00:00') {
                    $fecha_hora_entrada = Date::parse($ultima_salida)->addDays(1)->setTime(8, 0, 0);

                    // Si la fecha de entrada es domingo, la siguiente entrada será al día siguiente a las 8:00
                    if ($fecha_hora_entrada->format('N') == 7) {
                        $fecha_hora_entrada = Date::parse($ultima_salida)->addDays(2)->setTime(8, 0, 0);
                    }
                    $fecha_hora_salida = Date::parse($fecha_hora_entrada)->setTime(12, 0, 0);
                }

            }

        } else {
            $fecha_hora_entrada = Date::create(2022, 11, 1, 8, 0, 0);
            $fecha_hora_salida = Date::create(2022, 11, 1, 12, 0, 0);
        }

        return [
            'empleado_id' => $empleado->id,
            'fecha_hora_entrada' => $fecha_hora_entrada,
            'fecha_hora_salida' => $fecha_hora_salida,
            'created_at' => $fecha_hora_entrada,
            'updated_at' => $fecha_hora_salida,
        ];
    }
}
