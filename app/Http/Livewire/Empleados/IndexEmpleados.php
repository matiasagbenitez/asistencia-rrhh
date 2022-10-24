<?php

namespace App\Http\Livewire\Empleados;

use App\Http\Services\EmpleadoService;
use App\Models\Area;
use App\Models\Departamento;
use Livewire\Component;
use App\Models\Empleado;
use App\Models\Puesto;
use Livewire\WithPagination;

class IndexEmpleados extends Component
{
    use WithPagination;

    public $collections = [
        'areas' => [],
        'departamentos' => [],
        'puestos' => [],
    ];

    public $filters = [
        'search' => '',
        'area' => '',
        'departamento' => '',
        'puesto' => '',
    ];

    protected $listeners = ['render', 'delete'];

    public function mount()
    {

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

    public function render()
    {
        // Insertar botón en lista para limpiar filtros (por ahora se limpia reseteando el select de área)
        $this->filters['area'] == '' ? $this->resetFilters() : null;

        $this->collections['areas'] = Area::orderBy('nombre')->get();
        $this->collections['departamentos'] = Departamento::orderBy('nombre')->where('area_id', $this->filters['area'])->get();
        $this->collections['puestos'] = Puesto::orderBy('nombre')->where('departamento_id', $this->filters['departamento'])->get();

        $empleados = $this->getEmpleados();

        return view('livewire.empleados.index-empleados', compact('empleados'));
    }

    public function filters($queryBuilder){

        ($this->filters['area'] != '') ? $queryBuilder->where('areas.id', $this->filters['area']) : null;
        ($this->filters['puesto'] != '') ? $queryBuilder->where('puestos.id', $this->filters['puesto']) : null;
        ($this->filters['departamento'] != '') ? $queryBuilder->where('departamentos.id', $this->filters['departamento']) : null;
        ($this->filters['search'] != '') ? $queryBuilder->where(function ($query) {
            $query->where('empleados.nombre', 'LIKE', '%' . $this->filters['search'] . '%')
                ->orWhere('empleados.apellido', 'LIKE', '%' . $this->filters['search'] . '%')
                ->orWhere('empleados.cuil', 'LIKE', '%' . $this->filters['search'] . '%');
        }) : null;

        return $queryBuilder;
    }

    public function getEmpleados(){
        $queryBuilder = EmpleadoService::QBEmpleadoCompleto();
        return $this->filters($queryBuilder)->paginate(10);
    }

    public function resetFilters(){
        $this->filters['departamento'] = '';
        $this->filters['puesto'] = '';
        $this->filters['area'] = '';
    }
}
