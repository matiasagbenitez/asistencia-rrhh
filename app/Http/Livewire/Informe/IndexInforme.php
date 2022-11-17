<?php

namespace App\Http\Livewire\Informe;

use App\Http\Services\InformeService;
use App\Models\Empleado;
use Carbon\Carbon;
use Livewire\Component;

class IndexInforme extends Component
{
    public $empleado;

    public $collections = [
        'empleados' => [],
    ];

    public $filtros = [
        'fecha_inicio' => '',
        'fecha_fin' => '',
        'empleado_id' => '',
    ];

    public function mount()
    {
        $this->collections['empleados'] = Empleado::all();
        $this->filtros['fecha_inicio'] = Carbon::create(2022, 10, 3)->format('Y-m-d');
        $this->filtros['fecha_fin'] = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        $this->empleado = Empleado::find($this->filtros['empleado_id']);
        $stats = $this->getStats($this->empleado);

        return view('livewire.informe.index-informe', compact('stats'));
    }

    public function getStats($empleado)
    {
        if (!is_null($empleado)) {
            $horasExtras = InformeService::horasExtras(
                $empleado,
                $this->filtros['fecha_inicio'],
                $this->filtros['fecha_fin']
            );
            $asistencias = InformeService::asistencias(
                $empleado,
                $this->filtros['fecha_inicio'],
                $this->filtros['fecha_fin']
            );
            $horasTrabajadas = InformeService::horasTrabajadas(
                $empleado,
                $this->filtros['fecha_inicio'],
                $this->filtros['fecha_fin']
            );
            $faltasJustificadas = InformeService::faltasJustificadas(
                $empleado,
                $this->filtros['fecha_inicio'],
                $this->filtros['fecha_fin']
            );
            $faltasInjustificadas = InformeService::faltasInjustificadas(
                $empleado,
                $this->filtros['fecha_inicio'],
                $this->filtros['fecha_fin']
            );
            return [
                'horasExtras' => $horasExtras,
                'asistencias' => $asistencias,
                'horasTrabajadas' => $horasTrabajadas,
                'faltasJustificadas' => $faltasJustificadas,
                'faltasInjustificadas' => $faltasInjustificadas,
            ];
        }
        return null;
    }
}
