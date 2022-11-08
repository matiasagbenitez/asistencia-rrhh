<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\HoraExtra;
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
            $fecha_hora_inicio = $this->faker->dateTimeBetween($ultima_hora_extra->fecha_hora_fin, 'now');
        } else {
            // Si no tiene horas extras, crear una fecha aleatoria
            $fecha_hora_inicio = $this->faker->dateTimeBetween('-2 month', 'now')->format('Y-m-d H:i');
        }

        $cantidad_horas = $this->faker->numberBetween(1, 4);
        $fecha_hora_fin = date('Y-m-d H:i', strtotime($fecha_hora_inicio . ' + 3 hours'));
        $remuneracion_hora = $this->faker->numberBetween(500, 850);
        $total = $cantidad_horas * $remuneracion_hora;

        return [
            'fecha_hora_inicio' => $fecha_hora_inicio,
            'fecha_hora_fin' => $fecha_hora_fin,
            'cantidad_horas' => $cantidad_horas,
            'remuneracion_hora' => $remuneracion_hora,
            'remuneracion_total' => $total,
            'empleado_id' => $empleado_id,
        ];
    }
}
