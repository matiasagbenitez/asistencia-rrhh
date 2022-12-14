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
                'direccion' => 'Rivadavia 123, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 1,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'Jose',
                'apellido' => 'Lopez',
                'cuil' => '20-26456235-9',
                'direccion' => 'Av. San Martin 456, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 2,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'Maria',
                'apellido' => 'Lastra',
                'cuil' => '20-26458784-9',
                'direccion' => 'Las Heras 789, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 3,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'Guillermo',
                'apellido' => 'Atencio',
                'cuil' => '20-24567895-9',
                'direccion' => 'Av. Mitre 555, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 4,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'Karen',
                'apellido' => 'Ferrari',
                'cuil' => '27-18956532-9',
                'direccion' => 'San Lorenzo 700, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 4,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'Mateo',
                'apellido' => 'Fernandez',
                'cuil' => '20-29485612-9',
                'direccion' => 'Yerbal 400, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 5,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'Emma',
                'apellido' => 'Gil',
                'cuil' => '20-27598945-9',
                'direccion' => 'Pellegrini 100, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 6,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'Lautaro',
                'apellido' => 'Guijarro',
                'cuil' => '20-30265689-9',
                'direccion' => 'Av. Libertador 200, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 6,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'Pedro',
                'apellido' => 'Pizzi',
                'cuil' => '20-26594878-9',
                'direccion' => 'Av. de los Inmigrantes 200, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 7,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'Agustina',
                'apellido' => 'Scaloni',
                'cuil' => '20-26487515-9',
                'direccion' => 'Av. Libertador 200, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 7,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'German',
                'apellido' => 'Sosa',
                'cuil' => '20-23569845-9',
                'direccion' => 'Cochabamba 200, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 7,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'Mariana',
                'apellido' => 'Gomez',
                'cuil' => '20-26597845-9',
                'direccion' => 'Av. de los Inmigrantes 200, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 8,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'Esteban',
                'apellido' => 'Gonzalez',
                'cuil' => '20-25487512-9',
                'direccion' => 'Av. de los Inmigrantes 200, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 9,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'Alexis',
                'apellido' => 'Fracone',
                'cuil' => '20-26597845-9',
                'direccion' => 'Av. Mitre 200, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 10,
                'categoria_horario_id' => 1,
            ],
            [
                'nombre' => 'Alejandro',
                'apellido' => 'Picapiedra',
                'cuil' => '20-26594826-9',
                'direccion' => 'Av. Cocomarola 200, Posadas, Misiones',
                'fecha_ingreso' => '2022-11-01',
                'fecha_egreso' => null,
                'puesto_id' => 11,
                'categoria_horario_id' => 1,
            ]
        ];

        // Create empleados
        foreach ($empleados as $empleado) {
            \App\Models\Empleado::create($empleado);
        }
    }
}
