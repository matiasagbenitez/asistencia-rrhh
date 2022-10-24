<?php

namespace App\Http\Livewire\Empleados;

use App\Http\Services\EmpleadoService;
use Livewire\Component;

class ShowEmpleado extends Component
{
    public $isOpen = 0;
    public $empleado;

    public function mount($empleadoShow)
    {
        $this->empleado = $empleadoShow;
    }

    public function showEmpleado()
    {
        $this->isOpen = true;
    }

    public function render()
    {
        //No me permite pasar un registro de empleado completo, solamente lo pasa con las propiedades definidas en el modelo (???)
        //Entonces realizo una nueva consulta cuando se presiona el botón de ver
        $this->empleadoShow = EmpleadoService::QBEmpleadoCompleto()->where('empleados.id', $this->empleado->id)->first();
        return view('livewire.empleados.show-empleado');
    }
}
