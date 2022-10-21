<?php

namespace App\Http\Livewire\Empleados;

use App\Models\Area;
use App\Models\Departamento;
use Livewire\Component;
use App\Models\Empleado;
use App\Models\Puesto;
use Livewire\WithPagination;

class IndexEmpleados extends Component
{
    use WithPagination;

    public $search;
    public $areas, $departamentos, $puestos;
    public $area, $departamento, $puesto;

    protected $listeners = ['render', 'delete'];

    public function mount()
    {
        $this->areas = Area::orderBy('nombre')->get();
        $this->departamentos = Departamento::orderBy('nombre')->get();
        $this->puestos = Puesto::orderBy('nombre')->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Empleado $empleado)
    {
        try {
            $empleado->delete();
            $this->emit('render');
            $this->emit('success', '¡El empleado fue eliminado correctamente!');
        } catch (\Exception $ex) {
            $this->emit('error', 'Hubo un error al querer eliminar el empleado. Vuelve a intentarlo más tarde');
        }
    }

    public function render()
    {
        $empleados = Empleado::whereHas('puesto', function ($query) {
                $query->where('nombre', 'LIKE', '%' . $this->puesto . '%');
            })
            ->whereHas('puesto.departamento', function ($query) {
                $query->where('nombre', 'LIKE', '%' . $this->departamento . '%');
            })
            ->whereHas('puesto.departamento.area', function ($query) {
                $query->where('nombre', 'LIKE', '%' . $this->area . '%');
            })
            // Where nombre or apellido like $this->search
            ->where(function ($query) {
                $query->where('nombre', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('apellido', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('cuil', 'LIKE', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.empleados.index-empleados', compact('empleados'));
    }
}
