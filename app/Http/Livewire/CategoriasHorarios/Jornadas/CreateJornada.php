<?php

namespace App\Http\Livewire\CategoriasHorarios\Jornadas;

use App\Models\Jornada;
use Livewire\Component;

class CreateJornada extends Component
{
    public $isOpen = 0;
    public $collections;

    public $form = [
        'nombre' => '',
        'dia' => '',
        'tipo' => '',
        'hora_entrada' => '',
        'hora_salida' => '',
        'tolerancia' => '',
        'categoria_de_horario_id' => '',
    ];

    public function mount($categoria)
    {
        $this->categoria = $categoria;
    }

    public function render()
    {
        return view('livewire.categorias-horarios.jornadas.create-jornada');
    }

    protected $rules = [
        'form.nombre' => 'required',
        'form.dia' => 'required',
        'form.tipo' => 'required',
        'form.hora_entrada' => 'required',
        'form.hora_salida' => 'required',
        'form.tolerancia' => 'required',
        'form.categoria_de_horario_id' => 'required',
    ];

    protected $validationAttributes = [
        'form.nombre' => 'Nombre',
        'form.dia' => 'Día',
        'form.tipo' => 'Tipo',
        'form.hora_entrada' => 'Hora de entrada',
        'form.hora_salida' => 'Hora de salida',
        'form.tolerancia' => 'Tolerancia',
        'form.categoria_de_horario_id' => 'Categoría de horario',
    ];

    public function createJornada()
    {
        $this->resetInputFields();
        $this->toggleModal();
    }

    public function toggleModal()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function resetInputFields()
    {
        $this->reset('form');
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->form['categoria_de_horario_id'] = $this->categoria->id;
        $this->form['hora_entrada'] = date('H:i:s', strtotime($this->form['hora_entrada']));
        $this->form['hora_salida'] = date('H:i:s', strtotime($this->form['hora_salida']));
        Jornada::create($this->form);
        $this->resetInputFields();
        $this->toggleModal();
        $this->emitTo('categorias-horarios.jornadas.index-jornada', 'render');
        $this->emit('success', '¡Jornada agregada exitosamente!');
    }
}
