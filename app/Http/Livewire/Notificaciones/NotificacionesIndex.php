<?php

namespace App\Http\Livewire\Notificaciones;

use Livewire\Component;

class NotificacionesIndex extends Component
{
    public $notificaciones = [];

    public function mount()
    {
        $this->notificaciones = auth()->user()->notifications;

        // Mark all notifications as read
        auth()->user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        return view('livewire.notificaciones.notificaciones-index');
    }
}
