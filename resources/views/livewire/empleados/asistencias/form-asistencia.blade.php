<div class="mb-4 grid grid-cols-6 gap-3">
    <div class="col-span-3">
        <x-jet-label class="mb-2">Fecha y hora de entrada</x-jet-label>
        <x-jet-input wire:model="form.fecha_hora_entrada" type="datetime-local" class="w-full">
        </x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.fecha_hora_entrada" />
    </div>

    <div class="col-span-3">
        <x-jet-label class="mb-2">Fecha y hora de salida</x-jet-label>
        <x-jet-input wire:model="form.fecha_hora_salida" type="datetime-local" class="w-full">
        </x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.fecha_hora_salida" />
    </div>
</div>
