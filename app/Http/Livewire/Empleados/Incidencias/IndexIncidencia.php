<?php

namespace App\Http\Livewire\Empleados\Incidencias;

use App\Models\Empleado;
use App\Models\Incidencia;
use Livewire\Component;
use Livewire\WithPagination;

class IndexIncidencia extends Component
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
        $items = $this->getIncidencias();
        return view('livewire.empleados.incidencias.index-incidencia', compact('items'));
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

    public function getIncidencias()
    {
        $queryBuilder = Incidencia::where('empleado_id', $this->empleado->id)
            ->leftJoin('tipos_de_incidencia', 'incidencias.tipo_de_incidencia_id', '=', 'tipos_de_incidencia.id')
            ->select('incidencias.*', 'tipos_de_incidencia.nombre as tipo');
        return $this->filters($queryBuilder)->paginate(10);
    }

    public function resetFilters()
    {
    }
}
