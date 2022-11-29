<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\HoraExtra;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\Factories\Factory;

class HoraExtraFactory extends Factory
{

    public function definition()
    {
        $empleado_id = Empleado::inRandomOrder()->first()->id;
        $empleado = Empleado::find($empleado_id);

        // Si el empleado tiene horas extras, obtener la última
        if ($empleado->horas_extras) {
            $ultima_hora_extra = HoraExtra::where('empleado_id', $empleado_id)->latest()->first();
            // Add two weeks to the last hour extra
            $ultima_hora_extra->addWeeks(2);
            $fecha_hora_inicio = $this->faker->dateTimeBetween($ultima_hora_extra->fecha_hora_fin, '+2 week');
            while ($fecha_hora_inicio->format('N') < 7) {
                $fecha_hora_inicio = $this->faker->dateTimeBetween($ultima_hora_extra->fecha_hora_fin, '+2 week');
            }
        } else {
            // Si no tiene horas extras, crear una fecha aleatoria
            $fecha_hora_inicio = $this->faker->dateTimeBetween('-6 month', 'now');
            while ($fecha_hora_inicio->format('N') < 7) {
                $fecha_hora_inicio = $this->faker->dateTimeBetween('-6 month', 'now');
            }
        }

        $morning = rand(0, 1);
        if ($morning) {
            $fecha_hora_inicio->setTime(12, 0, 0);
            $fecha_hora_fin = Date::parse($fecha_hora_inicio)->addHours(rand(0, 2))->addMinutes(rand(0, 59));
        } else {
            $fecha_hora_inicio->setTime(20, 0, 0);
            $fecha_hora_fin = Date::parse($fecha_hora_inicio)->addHours(rand(0, 2))->addMinutes(rand(0, 59));
        }

        $cantidad_horas = Date::parse($fecha_hora_fin)->diffInMinutes($fecha_hora_inicio) / 60;

        return [
            'empleado_id' => $empleado_id,
            'fecha_hora_inicio' => $fecha_hora_inicio,
            'fecha_hora_fin' => $fecha_hora_fin,
            'cantidad_horas' => $cantidad_horas,
        ];
    }
}
