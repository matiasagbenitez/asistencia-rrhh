<?php

namespace App\Http\Livewire\Puestos;

use App\Models\Puesto;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPuestos extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = ['render', 'delete'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Puesto $puesto)
    {
        try {
            $puesto->delete();
            $this->emit('alert', 'success', '¡Puesto eliminado correctamente!');
        } catch (\Exception $e) {
            $this->emit('alert', 'error', 'No se pudo eliminar el puesto.');
        }
    }

    public function render()
    {
        $puestos = Puesto::where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('id')
            ->paginate(8);
        return view('livewire.puestos.index-puestos', compact('puestos'));
    }
}
