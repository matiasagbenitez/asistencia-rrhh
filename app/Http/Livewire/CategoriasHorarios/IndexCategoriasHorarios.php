<?php

namespace App\Http\Livewire\CategoriasHorarios;

use App\Models\CategoriasDeHorarios;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCategoriasHorarios extends Component
{
    use WithPagination;

    public $search;

    protected $listeners = ['render', 'delete'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(CategoriasDeHorarios $categoria_de_horario)
    {
        try {
            $categoria_de_horario->delete();
            $this->emit('render');
            $this->emit('success', '¡La categoría de horario se eliminó correctamente!');
        } catch (\Exception $e) {
            $this->emit('error', 'No se puede eliminar la categoría de horario porque está siendo usada.');
        }
    }

    public function render()
    {
        $categorias_de_horarios = CategoriasDeHorarios::where('nombre', 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.categorias-horarios.index-categorias-horarios', compact('categorias_de_horarios'));
    }
}
