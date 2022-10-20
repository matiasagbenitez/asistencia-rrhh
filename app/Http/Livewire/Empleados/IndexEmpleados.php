<?php

namespace App\Http\Livewire\Empleados;

use Livewire\Component;
use App\Models\Empleado;
use Livewire\WithPagination;

class IndexEmpleados extends Component
{
    use WithPagination;

    public $search;

    protected $listeners = ['render', 'delete'];

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
        $empleados = Empleado::where('nombre', 'LIKE', "%$this->search%")
            ->orWhere('apellido', 'LIKE', "%$this->search%")
            ->paginate(10);

        return view('livewire.empleados.index-empleados', compact('empleados'));
    }
}
