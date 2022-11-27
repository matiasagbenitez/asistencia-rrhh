<div>
    @if ($empleado)
        Empleado: {{$empleado->nombre}} {{$empleado->apellido}}
        <x-jet-danger-button wire:click="marcarAsistencia">
            {{ $asistencia->fecha_hora_salida ? "Marcar entrada" : "Marcar salida" }}
        </x-jet-danger-button>
    @endif
</div>
