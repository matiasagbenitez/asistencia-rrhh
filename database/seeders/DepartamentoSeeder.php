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
                'nombre' => 'Contabilidad',
                'area_id' => 1,
            ],
            [
                'nombre' => 'Compras',
                'area_id' => 2,
            ],
            [
                'nombre' => 'Ventas',
                'area_id' => 2,
            ],
            [
                'nombre' => 'Administración de Recursos Humanos',
                'area_id' => 3,
            ],
            [
                'nombre' => 'Formación y Capacitación',
                'area_id' => 3,
            ],
        ];

        foreach ($departamentos as $departamento) {
            \App\Models\Departamento::create($departamento);
        }
    }
}
