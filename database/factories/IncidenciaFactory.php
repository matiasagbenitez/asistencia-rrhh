<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\Incidencia;
use App\Models\TipoDeIncidencia;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncidenciaFactory extends Factory
{
    public function definition()
    {
        $tiposDeIncidencia = [1, 4, 5];

        $empleado_id = Empleado::inRandomOrder()->first()->id;
        $empleado = Empleado::find($empleado_id);
        $tipo_de_incidencia_id = $this->faker->randomElement($tiposDeIncidencia);

        if ($empleado->incidencias) {
            $ultima_incidencia = Incidencia::where('empleado_id', $empleado_id)->latest()->first();
        } else {
            $ultima_incidencia = $this->faker->dateTimeBetween('-6 month', '-5 month')->setTime(8, 0, 0);
        }

        switch ($tipo_de_incidencia_id) {
            case 1:
                $fecha_hora_inicio = $this->faker->dateTimeBetween($ultima_incidencia, '+2 week')->setTime(8, 0, 0);
                if ($fecha_hora_inicio->format('N') == 7) {
                    $fecha_hora_inicio->modify('+1 day');
                }
                $fecha_hora_fin = Date::parse($fecha_hora_inicio)->addHours(4);
                $fecha_hora_fin->modify('+3 day');
                break;

            case 4:
                $fecha_hora_inicio = $this->faker->dateTimeBetween($ultima_incidencia, '+2 week')->setTime(8, 0, 0);
                if ($fecha_hora_inicio->format('N') == 7) {
                    $fecha_hora_inicio->modify('+1 day');
                }
                $fecha_hora_fin = Date::parse($fecha_hora_inicio)->addHours(4);
                break;

            case 5:
                $fecha_hora_inicio = $this->faker->dateTimeBetween($ultima_incidencia, '+2 week')->setTime(8, 0, 0);
                if ($fecha_hora_inicio->format('N') == 7) {
                    $fecha_hora_inicio->modify('+1 day');
                }
                $fecha_hora_fin = Date::parse($fecha_hora_inicio)->addHours(4);
                break;

            default:
                # code...
                break;
        }

        return [
            'empleado_id' => $empleado_id,
            'tipo_de_incidencia_id' => $tipo_de_incidencia_id,
            'fecha_hora_inicio' => $fecha_hora_inicio,
            'fecha_hora_fin' => $fecha_hora_fin,
            'descripcion' => $this->faker->sentence(5)
        ];
    }
}
