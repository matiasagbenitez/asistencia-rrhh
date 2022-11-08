<div class="mb-4 grid grid-cols-6 gap-3">
    <div class="col-span-3">
        <x-jet-label class="mb-2 camelcase">Nombre</x-jet-label>
        <x-jet-input wire:model.defer="form.nombre" type="text" class="w-full"
            placeholder="Ingrese el nombre de incidencia"></x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.nombre" />
    </div>
    <div class="col-span-3">
        <x-jet-label class="mb-2">Tipo de incidencia</x-jet-label>
            <select wire:model.defer="form.tipo_de_incidencia_id" class="w-full input-control">
                <option value="" disabled>Seleccione un tipo de incidencia</option>
                @foreach ($tipos_de_incidencia as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.tipo_de_incidencia_id" />
    </div>
    </div>

    <div class="mb-4 grid grid-cols-6 gap-3">
    <div class="col-span-3">
        <x-jet-label class="mb-2">Fecha de la incidencia</x-jet-label>
        <x-jet-input wire:model.defer="form.fecha_hora" type="datetime-local" class="w-full">
        </x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.fecha_hora" />
    </div>
    <div class="col-span-3">
        <x-jet-label class="mb-2">¿Descuenta sueldo?</x-jet-label>
        <select wire:model.defer="form.descontar" class="w-full input-control">
                <option value="" disabled>Seleccione una opción</option>
                <option value="0">No</option>
                <option value="1">Si</option>
            </select>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.descontar" />
    </div>
    </div>

    <div class="mb-4">
    <x-jet-label class="mb-2">Descripción</x-jet-label>
    <x-jet-input wire:model.defer="form.descripcion" type="text" class="w-full"
        placeholder="Ingrese la descripción de la incidencia"></x-jet-input>
    <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.descripcion" />
</div>
