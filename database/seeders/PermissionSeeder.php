<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name'          => 'parametros.empresa',
                'guard_name'    => 'web',
            ],
            [
                'name'          => 'parametros.asistencia',
                'guard_name'    => 'web',
            ],
            [
                'name'          => 'empleados',
                'guard_name'    => 'web',
            ],
            [
                'name'          => 'informes',
                'guard_name'    => 'web',
            ],
        ];

        Permission::insert($permissions);
    }
}
