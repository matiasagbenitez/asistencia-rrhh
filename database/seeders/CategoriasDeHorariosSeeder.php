<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            ],
            [
                'nombre' => 'Tiempo completo con flexibilidad',
            ],
            [
                'nombre' => 'Medio tiempo con flexibilidad',
            ],
            [
                'nombre' => 'Tiempo parcial con flexibilidad',
            ],
        ];

        foreach ($categorias_de_horarios as $categoria_de_horario) {
            \App\Models\CategoriasDeHorarios::create($categoria_de_horario);
        }

    }
}
