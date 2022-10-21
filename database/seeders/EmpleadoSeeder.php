<?php

namespace Database\Seeders;

use App\Models\Puesto;
use Illuminate\Database\Seeder;
use App\Models\CategoriasDeHorarios;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoSeeder extends Seeder
{
    public function run()
    {

        $empleados = [
            [
                'nombre' => 'Juan',
                'apellido' => 'Perez',
                'cuil' => '20-12345678-9',
                'direccion' => 'Rivadavia 123',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Jose',
                'apellido' => 'Lopez',
                'cuil' => '20-26456235-9',
                'direccion' => 'Av. San Martin 456',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Maria',
                'apellido' => 'Sosa',
                'cuil' => '20-26458784-9',
                'direccion' => 'Las Heras 789',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Pedro',
                'apellido' => 'Gómez',
                'cuil' => '20-24567895-9',
                'direccion' => 'Av. Mitre 555',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Mariana',
                'apellido' => 'Ferrari',
                'cuil' => '27-18956532-9',
                'direccion' => 'San Lorenzo 700',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Mateo',
                'apellido' => 'Fernandez',
                'cuil' => '20-29485612-9',
                'direccion' => 'Yerbal 400',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Emma',
                'apellido' => 'Gil',
                'cuil' => '20-27598945-9',
                'direccion' => 'Pellegrini 100',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => Puesto::all()->random()->id,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Lautaro',
                'apellido' => 'Perez',
                'cuil' => '20-30265689-9',
                'direccion' => 'Av. Libertador 200',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
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
