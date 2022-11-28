<?php

namespace App\Http\Livewire\Empleados\Incidencias;

use App\Models\User;
use Livewire\Component;
use App\Models\Empleado;
use App\Models\Incidencia;
use Livewire\WithPagination;
use App\Notifications\NotificacionIncidenciaAceptada;

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

    public function delete(Incidencia $incidencia)
    {
        try {
            $incidencia->delete();
            $this->emit('success', '¡La incidencia fue eliminada correctamente!');
            $this->emit('render');
        } catch (\Exception $ex) {
            $this->emit('error', 'Hubo un error al querer eliminar la incidencia. Vuelve a intentarlo más tarde');
        }
    }

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

        return $this->filters($queryBuilder)->orderBy('fecha_hora_inicio', 'desc')->paginate(10);
    }

    public function resetFilters()
    {
    }

    public function aprobar($id)
    {
        $incidencia = Incidencia::find($id);
        $incidencia->aprobado = true;
        $incidencia->save();

        $empleado = User::find(2);
        $empleado->notify(new NotificacionIncidenciaAceptada($empleado, $incidencia));

        $this->emit('success', '¡La incidencia fue aprobada correctamente!');
        $this->emit('render');
    }
}
