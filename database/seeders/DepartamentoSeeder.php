<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    public function run()
    {
        $departamentos = [
            [
                'nombre' => 'Departamento 1',
                'area_id' => 1,
            ],
            [
                'nombre' => 'Departamento 2',
                'area_id' => 1,
            ],
            [
                'nombre' => 'Departamento 3',
                'area_id' => 2,
            ],
            [
                'nombre' => 'Departamento 4',
                'area_id' => 2,
            ],
            [
                'nombre' => 'Departamento 5',
                'area_id' => 3,
            ],
            [
                'nombre' => 'Departamento 6',
                'area_id' => 3,
            ],
            [
                'nombre' => 'Departamento 7',
                'area_id' => 4,
            ],
            [
                'nombre' => 'Departamento 8',
                'area_id' => 4,
            ],
            [
                'nombre' => 'Departamento 9',
                'area_id' => 5,
            ],
            [
                'nombre' => 'Departamento 10',
                'area_id' => 5,
            ],
        ];

        foreach ($departamentos as $departamento) {
            \App\Models\Departamento::create($departamento);
        }
    }
}
