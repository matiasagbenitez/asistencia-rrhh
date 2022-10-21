<?php

namespace App\Http\Livewire\Empleados;

use Livewire\Component;

class ShowEmpleado extends Component
{
    public $isOpen = 0;
    public $empleado;
    public $puesto, $departamento, $area;

    public function mount($empleado)
    {
        $this->empleado = $empleado;
        $this->puesto = $empleado->puesto->nombre;
        $this->departamento = $empleado->puesto->departamento->nombre;
        $this->area = $empleado->puesto->departamento->area->nombre;
    }

    public function showEmpleado()
    {
        $this->isOpen = true;
    }

    public function render()
    {
        return view('livewire.empleados.show-empleado');
    }
}
