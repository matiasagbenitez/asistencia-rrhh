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
                'nombre' => 'Turno mañana',
            ],
            [
                'nombre' => 'Turno tarde',
            ]
        ];

        foreach ($categorias_de_horarios as $categoria_de_horario) {

            CategoriasDeHorarios::create($categoria_de_horario);
        }

    }
}
