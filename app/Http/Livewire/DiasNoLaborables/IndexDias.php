<?php

namespace App\Http\Livewire\DiasNoLaborables;

use App\Models\DiaNoLaborable;
use Livewire\Component;

class IndexDias extends Component
{
    public $search;

    protected $listeners = ['render', 'delete'];

    public function delete($id)
    {
        try {
            DiaNoLaborable::find($id)->delete();
            $this->emit('render');
            $this->emit('success', '¡El día no laborable se eliminó correctamente!');
        } catch (\Throwable $th) {
            $this->emit('error', 'El día no laborable seleccionado no se puede eliminar.');
        }
    }

    public function render()
    {
        $dias = DiaNoLaborable::where('nombre', 'like', '%' . $this->search . '%')->get();
        return view('livewire.dias-no-laborables.index-dia', compact('dias'));
    }
}
