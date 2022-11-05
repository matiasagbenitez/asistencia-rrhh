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
                'nombre' => 'Contador',
                'departamento_id' => 1,
            ],
            [
                'nombre' => 'Auxiliar Contable',
                'departamento_id' => 1,
            ],
            [
                'nombre' => 'Jefe de Compras',
                'departamento_id' => 2,
            ],
            [
                'nombre' => 'Asistente de Compras',
                'departamento_id' => 2,
            ],
            [
                'nombre' => 'Jefe de Ventas',
                'departamento_id' => 3,
            ],
            [
                'nombre' => 'Asistente de Ventas',
                'departamento_id' => 3,
            ],
            [
                'nombre' => 'Cajero',
                'departamento_id' => 3,
            ],
            [
                'nombre' => 'Jefe de Recursos Humanos',
                'departamento_id' => 4,
            ],
            [
                'nombre' => 'Asistente de Recursos Humanos',
                'departamento_id' => 4,
            ],
            [
                'nombre' => 'Jefe de Formación y Capacitación',
                'departamento_id' => 5,
            ],
            [
                'nombre' => 'Asistente de Formación y Capacitación',
                'departamento_id' => 5,
            ],
        ];

        // Crear puestos para cada departamento
        foreach ($puestos as $puesto) {
            \App\Models\Puesto::create($puesto);
        }
    }
}
