<?php

namespace Database\Seeders;

use App\Models\Jornada;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JornadaSeeder extends Seeder
{
    public function run()
    {
        $jornadas = [
            // TIEMPO COMPLETO
            [
                'categoria_de_horario_id' => 1,
                'nombre' => 'Mañana',
                'tipo' => 'Normal',
                'dia' => 1,
                'hora_entrada' => '08:00:00',
                'hora_salida' => '12:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 1,
                'nombre' => 'Tarde',
                'tipo' => 'Normal',
                'dia' => 1,
                'hora_entrada' => '16:00:00',
                'hora_salida' => '20:00:00',
                'tolerancia' => 5,
            ],

            [
                'categoria_de_horario_id' => 1,
                'nombre' => 'Mañana',
                'tipo' => 'Normal',
                'dia' => 2,
                'hora_entrada' => '08:00:00',
                'hora_salida' => '12:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 1,
                'nombre' => 'Tarde',
                'tipo' => 'Normal',
                'dia' => 2,
                'hora_entrada' => '16:00:00',
                'hora_salida' => '20:00:00',
                'tolerancia' => 5,
            ],

            [
                'categoria_de_horario_id' => 1,
                'nombre' => 'Mañana',
                'tipo' => 'Normal',
                'dia' => 3,
                'hora_entrada' => '08:00:00',
                'hora_salida' => '12:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 1,
                'nombre' => 'Tarde',
                'tipo' => 'Normal',
                'dia' => 3,
                'hora_entrada' => '16:00:00',
                'hora_salida' => '20:00:00',
                'tolerancia' => 5,
            ],

            [
                'categoria_de_horario_id' => 1,
                'nombre' => 'Mañana',
                'tipo' => 'Normal',
                'dia' => 4,
                'hora_entrada' => '08:00:00',
                'hora_salida' => '12:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 1,
                'nombre' => 'Tarde',
                'tipo' => 'Normal',
                'dia' => 4,
                'hora_entrada' => '16:00:00',
                'hora_salida' => '20:00:00',
                'tolerancia' => 5,
            ],

            [
                'categoria_de_horario_id' => 1,
                'nombre' => 'Mañana',
                'tipo' => 'Normal',
                'dia' => 5,
                'hora_entrada' => '08:00:00',
                'hora_salida' => '12:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 1,
                'nombre' => 'Tarde',
                'tipo' => 'Normal',
                'dia' => 5,
                'hora_entrada' => '16:00:00',
                'hora_salida' => '20:00:00',
                'tolerancia' => 5,
            ],

            [
                'categoria_de_horario_id' => 1,
                'nombre' => 'Mañana',
                'tipo' => 'Normal',
                'dia' => 6,
                'hora_entrada' => '08:00:00',
                'hora_salida' => '12:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 1,
                'nombre' => 'Tarde',
                'tipo' => 'Normal',
                'dia' => 6,
                'hora_entrada' => '16:00:00',
                'hora_salida' => '20:00:00',
                'tolerancia' => 5,
            ],



            // TURNO MAÑANA
            [
                'categoria_de_horario_id' => 2,
                'nombre' => 'Mañana',
                'tipo' => 'Normal',
                'dia' => 1,
                'hora_entrada' => '08:00:00',
                'hora_salida' => '12:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 2,
                'nombre' => 'Mañana',
                'tipo' => 'Normal',
                'dia' => 2,
                'hora_entrada' => '08:00:00',
                'hora_salida' => '12:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 2,
                'nombre' => 'Mañana',
                'tipo' => 'Normal',
                'dia' => 3,
                'hora_entrada' => '08:00:00',
                'hora_salida' => '12:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 2,
                'nombre' => 'Mañana',
                'tipo' => 'Normal',
                'dia' => 4,
                'hora_entrada' => '08:00:00',
                'hora_salida' => '12:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 2,
                'nombre' => 'Mañana',
                'tipo' => 'Normal',
                'dia' => 5,
                'hora_entrada' => '08:00:00',
                'hora_salida' => '12:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 2,
                'nombre' => 'Mañana',
                'tipo' => 'Normal',
                'dia' => 6,
                'hora_entrada' => '08:00:00',
                'hora_salida' => '12:00:00',
                'tolerancia' => 5,
            ],

            // TURNO TARDE
            [
                'categoria_de_horario_id' => 3,
                'nombre' => 'Tarde',
                'tipo' => 'Normal',
                'dia' => 1,
                'hora_entrada' => '16:00:00',
                'hora_salida' => '20:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 3,
                'nombre' => 'Tarde',
                'tipo' => 'Normal',
                'dia' => 2,
                'hora_entrada' => '16:00:00',
                'hora_salida' => '20:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 3,
                'nombre' => 'Tarde',
                'tipo' => 'Normal',
                'dia' => 3,
                'hora_entrada' => '16:00:00',
                'hora_salida' => '20:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 3,
                'nombre' => 'Tarde',
                'tipo' => 'Normal',
                'dia' => 4,
                'hora_entrada' => '16:00:00',
                'hora_salida' => '20:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 3,
                'nombre' => 'Tarde',
                'tipo' => 'Normal',
                'dia' => 5,
                'hora_entrada' => '16:00:00',
                'hora_salida' => '20:00:00',
                'tolerancia' => 5,
            ],
            [
                'categoria_de_horario_id' => 3,
                'nombre' => 'Tarde',
                'tipo' => 'Normal',
                'dia' => 6,
                'hora_entrada' => '16:00:00',
                'hora_salida' => '20:00:00',
                'tolerancia' => 5,
            ],
        ];

        // Crear jornadas
        foreach ($jornadas as $jornada) {
            $jornada = Jornada::create($jornada);
        }
    }
}
