<div class="container py-6">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Informes</h2>
        </div>
    </x-slot>

    <div class="px-6 py-4 grid grid-cols-6 gap-2">
        <div class="col-span-2">
            <x-jet-label class="mb-2">Empleado</x-jet-label>
            <select wire:model="filtros.empleado_id" class="input-control w-full">
                <option value="">Seleccione un empleado</option>
                @foreach ($collections['empleados'] as $empleado)
                    <option value="{{ $empleado['id'] }}">{{ $empleado['nombre']}} {{ $empleado['apellido'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-2">
            <x-jet-label class="mb-2">Fecha de inicio</x-jet-label>
            <x-jet-input wire:model="filtros.fecha_inicio" type="date" class="w-full">
            </x-jet-input>
            <x-jet-input-error class="mt-2 text-xs font-semibold" for="filtros.fecha_inicio" />
        </div>
        <div class="col-span-2">
            <x-jet-label class="mb-2">Fecha de fin</x-jet-label>
            <x-jet-input wire:model="filtros.fecha_fin" type="date" class="w-full">
            </x-jet-input>
            <x-jet-input-error class="mt-2 text-xs font-semibold" for="filtros.fecha_fin" />
        </div>
    </div>

    <div class="px-6 py-4  gap-2">
        @if($stats)
            <h2 class="font-bold text-lg uppercase">Datos:</h2>
            <hr>
            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Horas trabajadas:</h3>
                <p class="text-md font-mono">{{ $stats["horasTrabajadas"] }}</p>
            </div>
            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Horas Extras:</h3>
                <p class="text-md font-mono">{{ $stats["horasExtras"] }}</p>
            </div>
            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Faltas injustificadas:</h3>
                <p class="text-md font-mono">{{ $stats["faltasInjustificadas"] }}</p>
            </div>
            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Faltas justificadas:</h3>
                <p class="text-md font-mono">{{ $stats["faltasJustificadas"] }}</p>
            </div>
            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Asistencias:</h3>
                <p class="text-md font-mono">{{ $stats["asistencias"] }}</p>
            </div>
        @else
            Seleccione un empleado para ver sus estadísticas.
        @endif
    </div>
</div>
