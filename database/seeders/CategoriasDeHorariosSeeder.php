<?php

namespace Database\Seeders;

use App\Models\Jornada;
use Illuminate\Database\Seeder;
use App\Models\CategoriasDeHorarios;

class CategoriasDeHorariosSeeder extends Seeder
{
    public function run()
    {
        $categorias_de_horarios = [
            [
                'nombre' => 'Tiempo completo',
            ],
            [
                'nombre' => 'Medio tiempo',
            ],
            [
                'nombre' => 'Tiempo parcial',
            ]
        ];

        foreach ($categorias_de_horarios as $categoria_de_horario) {

            CategoriasDeHorarios::create($categoria_de_horario);

            // Por cada categoría de horario se asocia una jornada
            $jornada = [
                'nombre' => 'Jornada normal',
                'dia' => Jornada::LUNES,
                'tipo' => 'Trabajo',
                'hora_entrada' => '08:00:00',
                'hora_salida' => '16:00:00',
                'tolerancia' => 0,
                'categoria_de_horario_id' => CategoriasDeHorarios::where('nombre', $categoria_de_horario['nombre'])->first()->id,
            ];

            Jornada::create($jornada);

        }

    }
}
