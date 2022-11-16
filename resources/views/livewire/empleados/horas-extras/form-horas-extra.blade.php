<div class="mb-4 grid grid-cols-6 gap-3">
    <div class="col-span-6">
        <x-jet-label class="mb-2">Fecha y hora de inicio</x-jet-label>
        <x-jet-input wire:model="form.fecha_hora_inicio" type="datetime-local" class="w-full">
        </x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.fecha_hora_inicio" />
    </div>

    <div class="col-span-6">
        <x-jet-label class="mb-2">Fecha y hora de fin</x-jet-label>
        <x-jet-input wire:model="form.fecha_hora_fin" type="datetime-local" class="w-full">
        </x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.fecha_hora_fin" />
    </div>

    <div class="col-span-6">
        <x-jet-label class="mb-2">Cantidad de horas (hs)</x-jet-label>
        <x-jet-input disabled wire:model="form.cantidad_horas" type="number" class="w-full text-center" placeholder="hs"></x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.cantidad_horas" />
    </div>
</div>
