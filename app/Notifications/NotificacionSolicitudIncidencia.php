<?php

namespace App\Notifications;

use App\Models\Empleado;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Models\TipoDeIncidencia;
use Illuminate\Support\Facades\Date;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificacionSolicitudIncidencia extends Notification
{
    use Queueable;

    public $empleadoId;
    public $empleadoEmail;

    public function __construct($admin, $form)
    {

        $this->admin = $admin;
        $this->empleado_id = $form['empleado_id'];
        $this->empleado = Empleado::find($form['empleado_id'])->nombre . ' ' . Empleado::find($form['empleado_id'])->apellido;
        $this->tipo_de_incidencia = TipoDeIncidencia::find($form['tipo_de_incidencia_id'])->nombre;
        $this->fecha_hora_inicio = Date::parse($form['fecha_hora_inicio'])->format('d-m-Y H:i');
        $this->fecha_hora_fin = Date::parse($form['fecha_hora_fin'])->format('d-m-Y H:i');
        $this->descripcion = $form['descripcion'];

        $this->empleadoId = $form['empleado_id'];
        $this->empleadoEmail = Str::slug($this->empleado) . '@gmail.com';
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $url = url('admin/empleados/'. $this->empleadoId .'/incidencias');
        $email = $this->empleadoEmail;

        return (new MailMessage)
                    ->from($email, $this->empleado)
                    ->subject('Solicitud de incidencia de ' . $this->empleado)
                    ->line('Se ha solicitado una incidencia para el empleado ' . $this->empleado . ' de tipo ' . $this->tipo_de_incidencia . ' desde las ' . $this->fecha_hora_inicio . ' hasta las ' . $this->fecha_hora_fin . '.')
                    ->action('Ver solicitud', $url)
                    ->line('Gracias por usar nuestra aplicación!');

    }

    public function toArray($notifiable)
    {
        return [
            'empleado_id' => $this->empleado_id,
            'empleado' => $this->empleado,
            'tipo_de_incidencia' => $this->tipo_de_incidencia,
            'fecha_hora_inicio' => $this->fecha_hora_inicio,
            'fecha_hora_fin' => $this->fecha_hora_fin,
            'descripcion' => $this->descripcion,
        ];
    }
}
