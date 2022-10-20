<?php

namespace Database\Seeders;

use App\Models\Puesto;
use Illuminate\Database\Seeder;
use App\Models\CategoriasDeHorarios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmpleadoSeeder extends Seeder
{
    public function run()
    {
        $empleados = [
            [
                'nombre' => 'Juan',
                'apellido' => 'Perez',
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Jose',
                'apellido' => 'Lopez',
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Maria',
                'apellido' => 'Sosa',
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Abril',
                'apellido' => 'Mayo',
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Mariana',
                'apellido' => 'Ferrari',
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Mateo',
                'apellido' => 'Fernandez',
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Emma',
                'apellido' => 'Gil',
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Lautaro',
                'apellido' => 'Perez',
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ]
        ];

        // Create empleados
        foreach ($empleados as $empleado) {
            \App\Models\Empleado::create($empleado);
        }
    }
}
