<div class="mb-4 grid grid-cols-6 gap-3">
        <div class="col-span-3">
            <x-jet-label class="mb-2">Fecha y hora de inicio</x-jet-label>
            <x-jet-input wire:model.defer="form.fecha_hora_inicio" type="datetime-local" class="w-full">
            </x-jet-input>
            <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.fecha_hora_inicio" />
        </div>
        <div class="col-span-3">
            <x-jet-label class="mb-2">Fecha y hora de fin</x-jet-label>
            <x-jet-input wire:model.defer="form.fecha_hora_fin" type="datetime-local" class="w-full">
            </x-jet-input>
            <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.fecha_hora_fin" />
        </div>

        <div class="col-span-3">
            <x-jet-label class="mb-2">Remuneración</x-jet-label>
            <x-jet-input wire:model.defer="form.remuneracion" type="number" class="w-full"
                placeholder="Ingrese el remuneracion de incidencia"></x-jet-input>
            <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.remuneracion" />
        </div>
</div>
