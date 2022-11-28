<div class="max-w-3xl mx-auto p-8 mt-12 bg-white rounded-lg shadow-lg">
    @if ($empleado)
        <div class="space-y-3 text-center">
            <h1 class="font-bold text-3xl">¡Hola, {{ $empleado->nombre }} {{ $empleado->apellido }}!</h1>
            <h2 class="font-bold text-lg">Marcar entrada/salida</h2>
            <x-jet-danger-button wire:click="marcarAsistencia">
                {{ $asistencia->fecha_hora_salida ? 'Marcar entrada' : 'Marcar salida' }}
            </x-jet-danger-button>
        </div>
    @endif
</div>
