<?php

namespace App\Http\Livewire\Informe;

use App\Http\Services\InformeService;
use App\Models\Empleado;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class IndexInforme extends Component
{
    public function mount()
    {
        $this->empleado = Empleado::find(1);
    }

    public function render()
    {
        $items = InformeService::horasExtras($this->empleado, '2021-01-01', '2023-01-31');

        $horasExtras = 0;
        foreach ($items as $item) {
            $inicio = Carbon::parse($item->fecha_hora_inicio);
            $fin = Carbon::parse($item->fecha_hora_fin);
            $horasExtras += $inicio->diffInHours($fin);
        }

        return view('livewire.informe.index-informe', compact('horasExtras'));
    }
}
