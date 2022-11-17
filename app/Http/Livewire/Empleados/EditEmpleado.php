<?php

namespace App\Http\Livewire\Empleados;

use App\Models\Puesto;
use Livewire\Component;
use App\Models\CategoriasDeHorarios;
use App\Models\Empleado;

class EditEmpleado extends Component
{
    public $isOpen = 0;
    public $puestos = [], $categorias_de_horarios = [];
    public $empleadoEdit;

    public $editForm = [
        'nombre' => '',
        'apellido' => '',
        'cuil' => '',
        'direccion' => '',
        'fecha_ingreso' => '',
        'fecha_egreso' => '',
        'categoria_horario_id' => '',
        'puesto_id' => '',
    ];

    protected $validationAttributes = [
        'editForm.nombre' => 'nombre',
        'editForm.apellido' => 'apellido',
        'editForm.cuil' => 'cuil',
        'editForm.direccion' => 'dirección',
        'editForm.fecha_ingreso' => 'fecha de ingreso',
        'editForm.fecha_egreso' => 'fecha de egreso',
        'editForm.categoria_horario_id' => 'categoría de horario',
        'editForm.puesto_id' => 'puesto',
    ];

    public function mount(Empleado $empleadoEdit)
    {
        $this->empleadoEdit = $empleadoEdit;
        $this->puestos = Puesto::all();
        $this->categorias_de_horarios = CategoriasDeHorarios::all();
    }

    public function editEmpleado()
    {
        $this->toggleModal();
        $this->editForm = [
            'nombre' => $this->empleadoEdit->nombre,
            'apellido' => $this->empleadoEdit->apellido,
            'cuil' => $this->empleadoEdit->cuil,
            'direccion' => $this->empleadoEdit->direccion,
            'fecha_ingreso' => $this->empleadoEdit->fecha_ingreso,
            'fecha_egreso' => $this->empleadoEdit->fecha_egreso,
            'categoria_horario_id' => $this->empleadoEdit->categoria_horario_id,
            'puesto_id' => $this->empleadoEdit->puesto_id,
        ];
        $this->puestos = Puesto::all();
        $this->categorias_de_horarios = CategoriasDeHorarios::all();
    }

    public function toggleModal()
    {
        $this->isOpen = !$this->isOpen;
        $this->resetErrorBag();
    }

    public function update()
    {
        $this->validate([
            'editForm.nombre' => 'required|string',
            'editForm.apellido' => 'required|string',
            'editForm.cuil' => 'required',
            'editForm.direccion' => 'required',
            'editForm.fecha_ingreso' => 'required|date',
            'editForm.fecha_egreso' => 'nullable',
            'editForm.categoria_horario_id' => 'integer|exists:categorias_de_horarios,id',
            'editForm.puesto_id' => 'integer|exists:puestos,id',
        ]);
        $this->empleadoEdit->update($this->editForm);
        $this->toggleModal();
        $this->emitTo('empleados.detalle-empleado', 'render');
        $this->emit('success', '¡El empleado se actualizó correctamente!');
    }

    public function render()
    {
        return view('livewire.empleados.edit-empleado');
    }
}
