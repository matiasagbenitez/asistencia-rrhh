<?php

namespace App\Http\Livewire\Departamentos;

use App\Models\Area;
use Livewire\Component;
use App\Models\Departamento;
use Livewire\WithPagination;

class IndexDepartamentos extends Component
{
    use WithPagination;

    public $search, $areas, $area;
    protected $listeners = ['render', 'delete'];

    public function mount()
    {
        $this->areas = Area::orderBy('nombre', 'ASC')->get();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Departamento $departamento)
    {
        try {
            $departamento->delete();
            $this->emit('render');
            $this->emit('success', '¡Departamento eliminado correctamente!');
        } catch (\Throwable $th) {
            $this->emit('error', 'El departamento seleccionado no se puede eliminar porque tiene puestos asociados.');
        }
    }

    public function render()
    {
        $departamentos = Departamento::where('nombre', 'LIKE', "%{$this->search}%")
            ->whereHas('area', function ($query) {
                $query->where('nombre', 'LIKE', "%{$this->area}%");
            })
            ->orderBy('nombre')
            ->paginate(5);

        return view('livewire.departamentos.index-departamentos', compact('departamentos'));
    }
}
