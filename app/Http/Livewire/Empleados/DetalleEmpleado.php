<?php

namespace App\Http\Livewire\Empleados;

use App\Models\Empleado;
use Livewire\Component;

class DetalleEmpleado extends Component
{
    protected $listeners = ['render'];

    public function mount(Empleado $empleado)
    {
        $this->empleado = $empleado;
    }

    public function render()
    {
        return view('livewire.empleados.detalle-empleado');
    }
}
