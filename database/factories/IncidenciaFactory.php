<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\Incidencia;
use App\Models\TipoDeIncidencia;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncidenciaFactory extends Factory
{
    public function definition()
    {
        $empleado_id = Empleado::inRandomOrder()->first()->id;
        $empleado = Empleado::find($empleado_id);

        $descripcion = $this->faker->sentence(10);

        // Si el empleado tiene incidencias, obtener la última
        if ($empleado->incidencias) {
            $ultima_incidencia = Incidencia::where('empleado_id', $empleado_id)->latest()->first();
        } else {
            // Si no tiene incidencias, crear una fecha aleatoria
            $ultima_incidencia = $this->faker->dateTimeBetween('-2 month', 'now');
        }

        // Fecha_hora debe ser mayor a la fecha_hora de la última incidencia
        $fecha_hora_inicio = $this->faker->dateTimeBetween($ultima_incidencia, 'now');
        $tipo_de_incidencia_id = TipoDeIncidencia::inRandomOrder()->first()->id;

        return [
            'empleado_id' => $empleado_id,
            'tipo_de_incidencia_id' => $tipo_de_incidencia_id,
            'fecha_hora_inicio' => $fecha_hora_inicio,
            'fecha_hora_fin' => null,
            'descripcion' => $descripcion,
        ];
    }
}
