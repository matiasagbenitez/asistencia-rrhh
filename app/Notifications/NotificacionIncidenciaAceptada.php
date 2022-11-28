<?php

namespace App\Notifications;

use App\Models\Incidencia;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Http\Livewire\Calendario\Empleado;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificacionIncidenciaAceptada extends Notification
{
    use Queueable;

    public $empleadoId;
    public $empleadoEmail;

    public function __construct($empleado, $incidencia)
    {
        $this->empleado = $empleado;
        // $this->nombreCompleto = Empleado::find($incidencia['empleado_id'])->nombre . ' ' . Empleado::find($incidencia['empleado_id'])->apellido;
        // $this->empleadoEmail = Str::slug($this->nombreCompleto) . '@gmail.com';
        $this->incidencia = $incidencia;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $url = url('admin/empleados/'. auth()->user()->id .'/incidencias');
        // $email = $this->empleadoEmail;

        return (new MailMessage)
                    ->subject('Tu solicitud de incidencia ha sido aceptada')
                    ->line('Tu solicitud de incidencia ha sido aceptada.')
                    ->action('Ver solicitud', $url)
                    ->line('Gracias por usar nuestra aplicación!');
    }

    public function toArray($notifiable)
    {
        return [
            'empleado_id' => $this->empleado->id,
            'empleado' => $this->empleado->nombre . ' ' . $this->empleado->apellido,
            'tipo_de_incidencia' => $this->incidencia->tipoDeIncidencia->nombre,
            'fecha_hora_inicio' => $this->incidencia->fecha_hora_inicio,
            'fecha_hora_fin' => $this->incidencia->fecha_hora_fin,
            'descripcion' => $this->incidencia->descripcion,
        ];
    }
}
