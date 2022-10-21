<?php

namespace App\Http\Livewire\Puestos;

use App\Models\Area;
use App\Models\Departamento;
use App\Models\Puesto;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPuestos extends Component
{
    use WithPagination;

    public $search = '';
    public $departamentos, $departamento, $areas, $area;

    protected $listeners = ['render', 'delete'];

    public function mount()
    {
        $this->departamentos = Departamento::orderBy('nombre')->get();
        $this->areas = Area::orderBy('nombre')->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Puesto $puesto)
    {
        // dd($puesto);
        try {
            $puesto->delete();
            $this->emit('success', '¡Puesto eliminado correctamente!');
        } catch (\Exception $e) {
            $this->emit('error', 'El puesto seleccionado no se puede eliminar porque tiene empleados asociados.');
        }
    }

    public function render()
    {
        $puestos = Puesto::where('nombre', 'like', '%' . $this->search . '%')
            ->whereHas('departamento', function ($query) {
                $query->where('nombre', 'LIKE', "%{$this->departamento}%");
            })
            ->whereHas('departamento.area', function($query) {
                $query->where('nombre', 'LIKE', "%{$this->area}%");
            })
            ->orderBy('id')
            ->paginate(8);
        return view('livewire.puestos.index-puestos', compact('puestos'));
    }
}
