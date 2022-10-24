<?php

namespace App\Http\Services;

use App\Models\Empleado;

class EmpleadoService
{
    public static function QBEmpleadoCompleto(){

            $queryBuilder = Empleado::orderBy('id', 'desc')
                ->leftJoin('puestos', 'empleados.puesto_id', '=', 'puestos.id')
                ->leftJoin('departamentos', 'puestos.departamento_id', '=', 'departamentos.id')
                ->leftJoin('areas', 'departamentos.area_id', '=', 'areas.id')
                ->leftJoin('empresas', 'areas.empresa_id', '=', 'empresas.id')
                ->leftJoin('categorias_de_horarios', 'empleados.categoria_horario_id', '=', 'categorias_de_horarios.id')
                ->select('empleados.*',
                        'puestos.nombre as puesto',
                        'departamentos.nombre as departamento',
                        'areas.nombre as area',
                        'empresas.nombre as empresa',
                        'categorias_de_horarios.nombre as categoria_de_horario');

            return $queryBuilder;
        }
}
