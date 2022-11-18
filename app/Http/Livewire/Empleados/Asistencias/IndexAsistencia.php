<?php

namespace App\Http\Livewire\Empleados\Asistencias;

use App\Models\Asistencia;
use App\Models\Empleado;
use Livewire\Component;
use Livewire\WithPagination;

class IndexAsistencia extends Component
{
    use WithPagination;

    public $collections = [];

    public $filters = [];

    protected $listeners = ['render', 'delete'];

    public function mount(Empleado $empleado)
    {
        $this->empleado = $empleado;
    }

    public function render()
    {
        $items = $this->getAsistencias();
        return view('livewire.empleados.asistencias.index-asistencia', compact('items'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Asistencia $asistencia)
    {
        try {
            $asistencia->delete();
            $this->emit('success', '¡La asistencia fue eliminada correctamente!');
            $this->emit('render');
        } catch (\Exception $ex) {
            $this->emit('error', 'Hubo un error al eliminar la asistencia. Vuelve a intentarlo más tarde');
        }
    }

    public function filters($queryBuilder)
    {
        // Restricciones de búsqueda
        return $queryBuilder;
    }

    public function getAsistencias()
    {
        $queryBuilder = Asistencia::where('empleado_id', $this->empleado->id);
        return $this->filters($queryBuilder)->orderBy('fecha_hora_entrada', 'desc')->paginate(10);
    }

    public function resetFilters()
    {
    }
}
