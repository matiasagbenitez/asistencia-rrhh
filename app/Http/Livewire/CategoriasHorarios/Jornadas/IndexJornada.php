<?php

namespace App\Http\Livewire\CategoriasHorarios\Jornadas;

use App\Models\CategoriasDeHorarios;
use App\Models\Jornada;
use Livewire\Component;
use Livewire\WithPagination;

class IndexJornada extends Component
{
    use WithPagination;

    public $collections = [

    ];

    public $filters = [

    ];

    protected $listeners = ['render', 'delete'];

    public function mount(CategoriasDeHorarios $categorias_de_horarios)
    {
        $this->categoria = $categorias_de_horarios;
    }

    public function render()
    {
        $items = $this->getJornadas();
        return view('livewire.categorias-horarios.jornadas.index-jornada', compact('items'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // public function delete(Empleado $empleado)
    // {
    //     try {
    //         $empleado->delete();
    //         $this->emit('render');
    //         $this->emit('success', '¡El empleado fue eliminado correctamente!');
    //     } catch (\Exception $ex) {
    //         $this->emit('error', 'Hubo un error al querer eliminar el empleado. Vuelve a intentarlo más tarde');
    //     }
    // }

    public function filters($queryBuilder)
    {
        // Restricciones de búsqueda
        return $queryBuilder;
    }

    public function getJornadas()
    {
        $queryBuilder = Jornada::where('categoria_de_horario_id', $this->categoria->id);
        return $this->filters($queryBuilder)->paginate(10);
    }

    public function resetFilters()
    {
    }
}
