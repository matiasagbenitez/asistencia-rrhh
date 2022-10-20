<?php

namespace App\Http\Livewire\Areas;

use App\Models\Area;
use Livewire\Component;

class IndexAreas extends Component
{
    public $search;

    protected $listeners = ['render', 'delete'];

    public function delete($id)
    {
        try {
            Area::find($id)->delete();
            $this->emit('render');
            $this->emit('success', '¡El área se eliminó correctamente!');
        } catch (\Throwable $th) {
            $this->emit('error', '¡El área no se pudo eliminar!');
        }
    }

    public function render()
    {
        $areas = Area::where('nombre', 'like', '%' . $this->search . '%')->get();
        return view('livewire.areas.index-areas', compact('areas'));
    }
}
