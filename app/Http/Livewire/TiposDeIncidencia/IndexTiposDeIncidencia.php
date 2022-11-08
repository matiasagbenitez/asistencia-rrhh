<?php

namespace App\Http\Livewire\TiposDeIncidencia;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TipoDeIncidencia;

class IndexTiposDeIncidencia extends Component
{
    use WithPagination;
    public $search;
    protected $listeners = ['render', 'delete'];

    public function delete(TipoDeIncidencia $tipo_de_incidencia)
    {
        try {
            $tipo_de_incidencia->delete();
            $this->emit('render');
            $this->emit('success', '¡Tipo de incidencia eliminado correctamente!');
        } catch (\Throwable $th) {
            $this->emit('error', 'El tipo de incidencia seleccionado no se puede eliminar porque tiene incidencias asociadas.');
        }
    }

    public function render()
    {
        $tipos_de_incidencia = TipoDeIncidencia::where('nombre', 'LIKE', "%{$this->search}%")->paginate(8);

        return view('livewire.tipos-de-incidencia.index-tipos-de-incidencia', compact('tipos_de_incidencia'));
    }
}
