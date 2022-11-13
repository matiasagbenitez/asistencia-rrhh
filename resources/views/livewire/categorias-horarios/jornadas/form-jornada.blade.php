<div class="mb-4 grid grid-cols-6 gap-3">
    <div class="col-span-3">
        <x-jet-label class="mb-2">Nombre</x-jet-label>
        <x-jet-input wire:model.defer="form.nombre" type="text" class="w-full"
            placeholder="Ingrese el nombre de la jornada"></x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.nombre" />
    </div>
    <div class="col-span-3">
        <x-jet-label class="mb-2">Tipo</x-jet-label>
        <x-jet-input wire:model.defer="form.tipo" type="text" class="w-full"
            placeholder="Ingrese el tipo de la jornada"></x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.tipo" />
    </div>
    <div class="col-span-3">
        <x-jet-label class="mb-2">Dia</x-jet-label>
            <select wire:model.defer="form.dia" class="w-full input-control">
                <option value="" disabled>Seleccione un dia</option>
                @foreach ($collections['dias'] as $key => $dia)
                    <option value="{{ $key }}">{{ $dia }}</option>
                @endforeach
            </select>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.dia" />
    </div>

    <div class="col-span-3">
        <x-jet-label class="mb-2">Fecha y hora de inicio</x-jet-label>
        <x-jet-input wire:model.defer="form.hora_entrada" type="time" class="w-full">
        </x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.hora_entrada" />
    </div>
    <div class="col-span-3">
        <x-jet-label class="mb-2">Fecha y hora de fin</x-jet-label>
        <x-jet-input wire:model.defer="form.hora_salida" type="time" class="w-full">
        </x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.hora_salida" />
    </div>

    <div class="col-span-3">
        <x-jet-label class="mb-2">Tolerancia</x-jet-label>
        <x-jet-input wire:model.defer="form.tolerancia" type="number" class="w-full">
        </x-jet-input>
        <x-jet-input-error class="mt-2 text-xs font-semibold" for="form.tolerancia" />
    </div>
</div>
