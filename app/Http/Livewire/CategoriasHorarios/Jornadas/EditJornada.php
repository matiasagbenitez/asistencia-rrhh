<?php

namespace App\Http\Livewire\CategoriasHorarios\Jornadas;

use App\Models\Jornada;
use Livewire\Component;

class EditJornada extends Component
{
    public $isOpen = 0;
    public $horasExtra;
    public $collections = [
        'dias' => [],
    ];

    public $form = [
        'nombre' => '',
        'dia' => '',
        'tipo' => '',
        'hora_entrada' => '',
        'hora_salida' => '',
        'tolerancia' => '',
        'categoria_de_horario_id' => '',
    ];

    public function mount($jornada)
    {
        $this->jornada = $jornada;
        $this->collections['dias'] = [
            Jornada::LUNES => 'Lunes',
            Jornada::MARTES => 'Martes',
            Jornada::MIERCOLES => 'Miércoles',
            Jornada::JUEVES => 'Jueves',
            Jornada::VIERNES => 'Viernes',
            Jornada::SABADO => 'Sábado',
            Jornada::DOMINGO => 'Domingo',
        ];
    }

    public function render()
    {
        return view('livewire.categorias-horarios.jornadas.edit-jornada');
    }

    protected $validationAttributes = [
        'form.nombre' => 'Nombre',
        'form.dia' => 'Día',
        'form.tipo' => 'Tipo',
        'form.hora_entrada' => 'Hora de entrada',
        'form.hora_salida' => 'Hora de salida',
        'form.tolerancia' => 'Tolerancia',
        'form.categoria_de_horario_id' => 'Categoría de horario',
    ];

    public function editJornada()
    {
        $this->toggleModal();
        $this->form = [
            'nombre' => $this->jornada->nombre,
            'dia' => $this->jornada->dia,
            'tipo' => $this->jornada->tipo,
            'hora_entrada' => $this->jornada->hora_entrada,
            'hora_salida' => $this->jornada->hora_salida,
            'tolerancia' => $this->jornada->tolerancia,
            'categoria_de_horario_id' => $this->jornada->categoria_de_horario_id,
        ];
    }

    public function toggleModal()
    {
        $this->isOpen = !$this->isOpen;
        $this->resetErrorBag();
    }

    public function update()
    {
        $this->validate([
            'form.nombre' => 'required',
            'form.dia' => 'required',
            'form.tipo' => 'required',
            'form.hora_entrada' => 'required',
            'form.hora_salida' => 'required',
            'form.tolerancia' => 'required',
            'form.categoria_de_horario_id' => 'required',
        ]);
        $this->jornada->update($this->form);
        $this->toggleModal();
        $this->emitTo('categorias-horarios.jornadas.index-jornada', 'render');
        $this->emit('success', '¡Jornada se actualizó exitosamente!');
    }
}
