<div class="mb-4 grid grid-cols-6 gap-3">
    <div class="col-span-6">
        <x-jet-label class="mb-2 camelcase">Nombre</x-jet-label>
        <x-jet-input wire:model.defer="form.nombre" type="text" class="w-full"
            placeholder="Ingrese el nombre del tipo de incidencia"></x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.nombre" />
    </div>
</div>
