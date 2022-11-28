<div>
    <x-jet-button class="w-full" wire:click="editEmpleado">
        <i class="fas fa-edit mr-2"></i>
        Editar datos personales
    </x-jet-button>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            Editar datos personales
        </x-slot>

        <x-slot name="content">
            {{-- Nombre --}}
            <div class="mb-4 grid grid-cols-6 gap-3">
                <div class="col-span-3">
                    <x-jet-label class="mb-2">Nombre</x-jet-label>
                    <x-jet-input wire:model.defer="editForm.nombre" type="text" class="w-full"
                        placeholder="Ingrese el nombre del empleado"></x-jet-input>
                    <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.nombre" />
                </div>
                <div class="col-span-3">
                    <x-jet-label class="mb-2">Apellido</x-jet-label>
                    <x-jet-input wire:model.defer="editForm.apellido" type="text" class="w-full"
                        placeholder="Ingrese el apellido del empleado"></x-jet-input>
                    <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.apellido" />
                </div>
            </div>

            <div class="mb-4 grid grid-cols-6 gap-3">
                <div class="col-span-3">
                    <x-jet-label class="mb-2">CUIL</x-jet-label>
                    <x-jet-input wire:model.defer="editForm.cuil" type="text" class="w-full"
                        placeholder="Ingrese el CUIL del empleado"></x-jet-input>
                    <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.cuil" />
                </div>
                <div class="col-span-3">
                    <x-jet-label class="mb-2">Dirección</x-jet-label>
                    <x-jet-input wire:model.defer="editForm.direccion" type="text" class="w-full"
                        placeholder="Ingrese la dirección del empleado"></x-jet-input>
                    <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.direccion" />
                </div>
            </div>

            <div class="mb-4 grid grid-cols-6 gap-3">
                <div class="col-span-3">
                    <x-jet-label class="mb-2">Fecha ingreso</x-jet-label>
                    <x-jet-input wire:model.defer="editForm.fecha_ingreso" type="date" class="w-full"></x-jet-input>
                    <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.fecha_ingreso" />
                </div>
                <div class="col-span-3">
                    <x-jet-label class="mb-2">Fecha egreso</x-jet-label>
                    <x-jet-input wire:model.defer="editForm.fecha_egreso" type="date" class="w-full"></x-jet-input>
                    <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.fecha_egreso" />
                </div>
            </div>

            {{-- Categoria de horario --}}
            <div class="mb-4">
                <x-jet-label class="mb-2">Categoría de horario</x-jet-label>
                <select wire:model.defer="editForm.categoria_horario_id" class="w-full input-control">
                    <option value="" disabled>Seleccione una categoría</option>
                    @foreach ($categorias_de_horarios as $categoria_de_horario)
                        <option value="{{ $categoria_de_horario->id }}">{{ $categoria_de_horario->nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.categoria_horario_id" />
            </div>


            <div class="mb-4">
                <x-jet-label class="mb-2">Puesto</x-jet-label>

                <select wire:model.defer="editForm.puesto_id" class="w-full input-control">
                    <option value="" disabled>Seleccione un puesto</option>
                    @foreach ($puestos as $puesto)
                        <option value="{{ $puesto->id }}">
                            {{ $puesto->nombre }} - {{ $puesto->departamento->nombre }} ({{ $puesto->departamento->area->nombre }})
                        </option>
                    @endforeach
                </select>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.puesto_id" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-end gap-3">
                <x-jet-danger-button wire:click="$set('isOpen', false)">
                    Cancelar
                </x-jet-danger-button>

                <x-jet-button wire:click="update">
                    Guardar cambios
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>

@push('script')
    <script>
        Livewire.on('success', message => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: 'success',
                title: message
            });
        });
    </script>
@endpush
