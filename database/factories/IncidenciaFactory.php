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
        $nombre = $this->faker->sentence(2);
        $descripcion = $this->faker->sentence(10);

        $empleado_id = Empleado::inRandomOrder()->first()->id;
        $empleado = Empleado::find($empleado_id);

        // Si el empleado tiene incidencias, obtener la última
        if ($empleado->incidencias) {
            $ultima_incidencia = Incidencia::where('empleado_id', $empleado_id)->latest()->first();
        } else {
            // Si no tiene incidencias, crear una fecha aleatoria
            $ultima_incidencia = $this->faker->dateTimeBetween('-2 month', 'now');
        }

        // Fecha_hora debe ser mayor a la fecha_hora de la última incidencia
        $fecha_hora = $this->faker->dateTimeBetween($ultima_incidencia, 'now');
        $descontar = $this->faker->boolean;
        $tipo_de_incidencia_id = TipoDeIncidencia::inRandomOrder()->first()->id;

        return [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'fecha_hora' => $fecha_hora,
            'descontar' => $descontar,
            'empleado_id' => $empleado_id,
            'tipo_de_incidencia_id' => $tipo_de_incidencia_id,
        ];
    }
}
