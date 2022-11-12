<?php

namespace App\Http\Livewire\Informe;

use App\Http\Services\InformeService;
use App\Models\Empleado;
use Carbon\Carbon;
use Livewire\Component;

class IndexInforme extends Component
{
    public function mount()
    {
        $this->empleado = Empleado::find(1);
    }

    public function render()
    {
        $horasExtras = InformeService::horasExtras($this->empleado, '2021-01-01', '2023-01-31');
        $asistencias = InformeService::asistencias($this->empleado, '2021-01-01', '2023-01-31');
        $horasTrabajadas = InformeService::horasTrabajadas($this->empleado, '2021-01-01', '2023-01-31');
        $faltasJustificadas = InformeService::faltasJustificadas($this->empleado, '2021-01-01', '2023-01-31');
        $faltasInjustificadas = InformeService::faltasInjustificadas($this->empleado, '2021-01-01', '2023-01-31');

        return view('livewire.informe.index-informe', compact(
            'horasExtras',
            'asistencias',
            'horasTrabajadas',
            'faltasJustificadas',
            'faltasInjustificadas',
        ));
    }
}
