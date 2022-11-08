<?php

namespace App\Http\Livewire\Empleados\HorasExtras;

use App\Models\HoraExtra;
use Livewire\Component;

class EditHorasExtra extends Component
{
    public $isOpen = 0;
    public $horasExtra;

    public function mount(HoraExtra $horasExtra)
    {
        $this->horasExtra = $horasExtra;
    }

    public function render()
    {
        return view('livewire.empleados.horas-extras.edit-horas-extra');
    }

    public $form = [
        'form.fecha_hora_inicio' => '',
        'form.fecha_hora_fin' => '',
        'form.cantidad_horas' => '',
        'form.remuneracion_hora' => '',
        'form.remuneracion_total' => '',
        'form.empleado_id' => '',
    ];

    protected $validationAttributes = [
        'form.fecha_hora_inicio' => 'Fecha y hora de inicio',
        'form.fecha_hora_fin' => 'Fecha y hora de fin',
        'form.cantidad_horas' => 'Cantidad de horas',
        'form.remuneracion_hora' => 'Remuneración por hora',
        'form.remuneracion_total' => 'Remuneración total',
    ];

    public function editHorasExtra()
    {
        $this->toggleModal();
        $this->form = [
            'fecha_hora_inicio' => $this->horasExtra->fecha_hora_inicio,
            'fecha_hora_fin' => $this->horasExtra->fecha_hora_fin,
            'cantidad_horas' => $this->horasExtra->cantidad_horas,
            'remuneracion_hora' => $this->horasExtra->remuneracion_hora,
            'remuneracion_total' => $this->horasExtra->remuneracion_total,
            'empleado_id' => $this->horasExtra->empleado_id,
        ];
    }

    public function toggleModal()
    {
        $this->isOpen = !$this->isOpen;
        $this->resetErrorBag();
    }

    public function updatedFormFechaHoraFin()
    {
        if ($this->form['fecha_hora_inicio'] && $this->form['fecha_hora_fin']) {
            // Validar que la fecha de inicio sea menor a la fecha de fin
            $this->validate([
                'form.fecha_hora_inicio' => 'before:form.fecha_hora_fin',
                'form.fecha_hora_fin' => 'after:form.fecha_hora_inicio',
            ]);

            $hora_inicio = strtotime($this->form['fecha_hora_inicio']);
            $hora_fin = strtotime($this->form['fecha_hora_fin']);
            $this->form['cantidad_horas'] = round(abs($hora_fin - $hora_inicio) / 3600, 2);
        } else {
            $this->form['cantidad_horas'] = '-';
        }
    }

    public function updatedFormRemuneracionHora()
    {
        if ($this->form['cantidad_horas'] && $this->form['remuneracion_hora']) {
            $this->form['remuneracion_total'] = $this->form['cantidad_horas'] * $this->form['remuneracion_hora'];
        } else {
            $this->form['remuneracion_total'] = '';
        }
    }

    public function update()
    {
        $this->validate([
            'form.fecha_hora_inicio' => 'required|before:form.fecha_hora_fin',
            'form.fecha_hora_fin' => 'required|after:form.fecha_hora_inicio',
            'form.cantidad_horas' => 'required',
            'form.remuneracion_hora' => 'required',
            'form.remuneracion_total' => 'required',
            'form.empleado_id' => 'required',
        ]);
        $this->horasExtra->update($this->form);
        $this->toggleModal();
        $this->emitTo('empleados.horas-extras.index-horas-extra', 'render');
        $this->emit('success', '¡La hora extra se actualizó correctamente!');
    }
}
