<?php

namespace App\Http\Livewire\Departamentos;

use Livewire\Component;
use App\Models\Departamento;
use Livewire\WithPagination;

class IndexDepartamentos extends Component
{
    use WithPagination;

    public $search;

    protected $listeners = ['render', 'delete'];

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
            $this->emit('error', 'Sucedió un error al eliminar el departamento.');
        }
    }

    public function render()
    {
        $departamentos = Departamento::where('nombre', 'LIKE', "%{$this->search}%")
            ->orderBy('nombre')
            ->paginate(5);

        return view('livewire.departamentos.index-departamentos', compact('departamentos'));
    }
}
