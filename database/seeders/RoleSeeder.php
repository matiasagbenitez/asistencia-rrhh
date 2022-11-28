<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\TranslationId;
use App\Models\Translation;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(
            [
                'name'              => 'Admin',
                'guard_name'        => 'web',
            ]
        )->syncPermissions(
            [
                'calendario.admin',
                'parametros.empresa',
                'parametros.asistencia',
                'empleados',
                'informes',
            ]
        );
        Role::updateOrCreate(
            [
                'name'              => 'Empleado',
                'guard_name'        => 'web',
            ]
        )->syncPermissions(
            [
                'perfil.empleados',
                'calendario.empleados',
            ]
        );
    }
}
