<?php

namespace App\Http\Livewire\Empleados;

use App\Models\Puesto;
use Livewire\Component;
use App\Models\CategoriasDeHorarios;
use App\Models\Empleado;

class CreateEmpleado extends Component
{
    public $isOpen = 0;
    public $puestos = [], $categorias_de_horarios = [];

    public $createForm = [
        'nombre' => '',
        'apellido' => '',
        'cuil' => '',
        'direccion' => '',
        'fecha_ingreso' => '',
        // 'fecha_egreso' => '',
        'categoria_horario_id' => '',
        'puesto_id' => '',
    ];

    protected $rules = [
        'createForm.nombre' => 'required|string',
        'createForm.apellido' => 'required|string',
        'createForm.cuil' => 'required',
        'createForm.direccion' => 'required',
        'createForm.fecha_ingreso' => 'required|date',
        // 'createForm.fecha_egreso' => 'nullable',
        'createForm.categoria_horario_id' => 'integer|exists:categorias_de_horarios,id',
        'createForm.puesto_id' => 'integer|exists:puestos,id',
    ];

    protected $validationAttributes = [
        'createForm.nombre' => 'nombre',
        'createForm.apellido' => 'apellido',
        'createForm.cuil' => 'cuil',
        'createForm.direccion' => 'dirección',
        'createForm.fecha_ingreso' => 'fecha de ingreso',
        // 'createForm.fecha_egreso' => 'fecha de egreso',
        'createForm.categoria_horario_id' => 'categoría de horario',
        'createForm.puesto_id' => 'puesto',
    ];

    public function createEmpleado()
    {
        $this->resetInputFields();
        $this->toggleModal();
        $this->puestos = Puesto::all();
        $this->categorias_de_horarios = CategoriasDeHorarios::all();
    }

    public function toggleModal()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function resetInputFields()
    {
        $this->reset('createForm');
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();
        Empleado::create($this->createForm);
        $this->resetInputFields();
        $this->toggleModal();
        $this->emitTo('empleados.index-empleados', 'render');
        $this->emit('success', '¡Empleado agregado exitosamente!');
    }

    public function render()
    {
        return view('livewire.empleados.create-empleado');
    }
}
