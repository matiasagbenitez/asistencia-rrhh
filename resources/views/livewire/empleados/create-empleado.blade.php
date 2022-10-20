<div>
    <x-jet-secondary-button wire:click="createEmpleado">
        <i class="fas fa-plus mr-2"></i>
        Crear nuevo empleado
    </x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            Crear nuevo empleado
        </x-slot>

        <x-slot name="content">
            {{-- Nombre --}}
            <div class="mb-4">
                <x-jet-label class="mb-2">Nombre</x-jet-label>
                <x-jet-input wire:model.defer="createForm.nombre" type="text" class="w-full"
                    placeholder="Ingrese el nombre del empleado"></x-jet-input>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="createForm.nombre" />
            </div>

            {{-- Apellido --}}
            <div class="mb-4">
                <x-jet-label class="mb-2">Apellido</x-jet-label>
                <x-jet-input wire:model.defer="createForm.apellido" type="text" class="w-full"
                    placeholder="Ingrese el apellido del empleado"></x-jet-input>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="createForm.apellido" />
            </div>

            {{-- Categoria de horario --}}
            <div class="mb-4">
                <x-jet-label class="mb-2">Categoría de horario</x-jet-label>
                <select wire:model.defer="createForm.categoria_horario_id" class="w-full input-control">
                    <option value="" disabled>Seleccione una categoría</option>
                    @foreach ($categorias_de_horarios as $categoria_de_horario)
                        <option value="{{ $categoria_de_horario->id }}">{{ $categoria_de_horario->nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="createForm.categoria_horario_id" />
            </div>


            <div class="mb-4">
                <x-jet-label class="mb-2">Puesto</x-jet-label>

                <select wire:model.defer="createForm.puesto_id" class="w-full input-control">
                    <option value="" disabled>Seleccione un puesto</option>
                    @foreach ($puestos as $puesto)
                        <option value="{{ $puesto->id }}">
                            {{ $puesto->nombre }} - {{ $puesto->departamento->nombre }} ({{ $puesto->departamento->area->nombre }})
                        </option>
                    @endforeach
                </select>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="createForm.puesto_id" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-end gap-3">
                <x-jet-danger-button wire:click="$set('isOpen', false)">
                    Cancelar
                </x-jet-danger-button>

                <x-jet-button wire:click="save">
                    Crear empleado
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
