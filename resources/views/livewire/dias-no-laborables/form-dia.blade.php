<div class="mb-4 grid grid-cols-6 gap-3">
    <div class="col-span-3">
        <x-jet-label class="mb-2">Nombre</x-jet-label>
        <x-jet-input wire:model.defer="form.nombre" type="text" class="w-full"
            placeholder="Ingrese un nombre para el día no laborable"></x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.nombre" />
    </div>
    <div class="col-span-3">
        <x-jet-label class="mb-2">Fecha</x-jet-label>
        <x-jet-input wire:model.defer="form.fecha" type="date" class="w-full">
        </x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.fecha" />
    </div>
</div>

