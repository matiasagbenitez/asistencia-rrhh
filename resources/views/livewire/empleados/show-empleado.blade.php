<div>
    <x-jet-secondary-button wire:click="showEmpleado">
        <i class="fas fa-eye"></i>
    </x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h1 class="font-bold text-2xl">
                Detalles de empleado
            </h1>
        </x-slot>

        <x-slot name="content">
            <h2 class="font-bold text-lg uppercase">Datos personales</h2>
            <hr>

            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Nombre:</h3>
                <p class="text-md font-mono">{{ $empleado->nombre }}</p>
            </div>

            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Apellido:</h3>
                <p class="text-md font-mono">{{ $empleado->apellido }}</p>
            </div>

            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">CUIL:</h3>
                <p class="text-md font-mono">{{ $empleado->cuil }}</p>
            </div>

            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Dirección:</h3>
                <p class="text-md font-mono">{{ $empleado->direccion }}</p>
            </div>

            <h2 class="font-bold text-lg uppercase mt-3">Datos laborales</h2>
            <hr>

            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Área:</h3>
                <p class="text-md font-mono">{{ $area }}</p>
            </div>

            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Departamento:</h3>
                <p class="text-md font-mono">{{ $departamento }}</p>
            </div>

            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Puesto:</h3>
                <p class="text-md font-mono">{{ $puesto }}</p>
            </div>

            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Fecha ingreso:</h3>
                <p class="text-md font-mono">{{ $empleado->fecha_ingreso }}</p>
            </div>

            @if ($empleado->fecha_egreso)
                <div class="flex items-baseline space-x-2">
                    <h3 class="mt-3 text-md font-bold">Fecha egreso:</h3>
                    <p class="text-md font-mono">{{ $empleado->fecha_ingreso }}</p>
                </div>
            @endif

        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-end gap-3">
                <x-jet-button wire:click="$set('isOpen', false)">
                    Volver
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
