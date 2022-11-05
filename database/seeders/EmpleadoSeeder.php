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
                'puesto_id' => 1,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Jose',
                'apellido' => 'Lopez',
                'cuil' => '20-26456235-9',
                'direccion' => 'Av. San Martin 456',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 2,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Maria',
                'apellido' => 'Sosa',
                'cuil' => '20-26458784-9',
                'direccion' => 'Las Heras 789',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 3,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Pedro',
                'apellido' => 'Gómez',
                'cuil' => '20-24567895-9',
                'direccion' => 'Av. Mitre 555',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 4,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Mariana',
                'apellido' => 'Ferrari',
                'cuil' => '27-18956532-9',
                'direccion' => 'San Lorenzo 700',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 4,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Mateo',
                'apellido' => 'Fernandez',
                'cuil' => '20-29485612-9',
                'direccion' => 'Yerbal 400',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 5,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Emma',
                'apellido' => 'Gil',
                'cuil' => '20-27598945-9',
                'direccion' => 'Pellegrini 100',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 6,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Lautaro',
                'apellido' => 'Perez',
                'cuil' => '20-30265689-9',
                'direccion' => 'Av. Libertador 200',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 6,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Pedro',
                'apellido' => 'Gomez',
                'cuil' => '20-26594878-9',
                'direccion' => 'Av. de los Inmigrantes 200',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 7,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Agustina',
                'apellido' => 'Gonzalez',
                'cuil' => '20-26487515-9',
                'direccion' => 'Av. Libertador 200',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 7,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'German',
                'apellido' => 'Sosa',
                'cuil' => '20-23569845-9',
                'direccion' => 'Cochabamba 200',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 7,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Mariana',
                'apellido' => 'Gomez',
                'cuil' => '20-26597845-9',
                'direccion' => 'Av. de los Inmigrantes 200',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 8,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Juan',
                'apellido' => 'Gonzalez',
                'cuil' => '20-25487512-9',
                'direccion' => 'Av. de los Inmigrantes 200',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 9,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Juan',
                'apellido' => 'Perez',
                'cuil' => '20-26597845-9',
                'direccion' => 'Av. Mitre 200',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 10,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ],
            [
                'nombre' => 'Alejandro',
                'apellido' => 'Picapiedra',
                'cuil' => '20-26594826-9',
                'direccion' => 'Av. Cocomarola 200',
                'fecha_ingreso' => '2022-05-01',
                'fecha_egreso' => null,
                'puesto_id' => 11,
                'categoria_horario_id' => CategoriasDeHorarios::all()->random()->id,
            ]
        ];

        // Create empleados
        foreach ($empleados as $empleado) {
            \App\Models\Empleado::create($empleado);
        }
    }
}
