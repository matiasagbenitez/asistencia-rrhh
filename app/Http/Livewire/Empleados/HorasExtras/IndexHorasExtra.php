<?php

namespace App\Http\Livewire\Empleados\HorasExtras;

use App\Models\Empleado;
use App\Models\HoraExtra;
use Livewire\Component;
use Livewire\WithPagination;

class IndexHorasExtra extends Component
{
    use WithPagination;

    public $collections = [

    ];

    public $filters = [

    ];

    protected $listeners = ['render', 'delete'];

    public function mount(Empleado $empleado)
    {
        $this->empleado = $empleado;
    }

    public function render()
    {
        $items = $this->getHorasExtras();
        return view('livewire.empleados.horas-extras.index-horas-extra', compact('items'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // public function delete(Empleado $empleado)
    // {
    //     try {
    //         $empleado->delete();
    //         $this->emit('render');
    //         $this->emit('success', '¡El empleado fue eliminado correctamente!');
    //     } catch (\Exception $ex) {
    //         $this->emit('error', 'Hubo un error al querer eliminar el empleado. Vuelve a intentarlo más tarde');
    //     }
    // }

    public function filters($queryBuilder)
    {
        // Restricciones de búsqueda
        return $queryBuilder;
    }

    public function getHorasExtras()
    {
        $queryBuilder = HoraExtra::where('empleado_id', $this->empleado->id);
        return $this->filters($queryBuilder)->paginate(10);
    }

    public function resetFilters()
    {
    }
}
