<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PuestoSeeder extends Seeder
{
    public function run()
    {
        $puestos = [
            [
                'nombre' => 'Jefe de departamento',
            ],
            [
                'nombre' => 'Técnico',
            ],
            [
                'nombre' => 'Auxiliar',
            ],
            [
                'nombre' => 'Operario',
            ]
        ];

        // Crear puestos para cada departamento
        foreach (\App\Models\Departamento::all() as $departamento) {
            foreach ($puestos as $puesto) {
                $puesto['departamento_id'] = $departamento->id;
                \App\Models\Puesto::create($puesto);
            }
        }
    }
}
