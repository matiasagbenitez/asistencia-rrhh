<div>
    <x-jet-button wire:click="editDepartamento">
        <i class="fas fa-edit"></i>
    </x-jet-button>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            Editar departamento
        </x-slot>

        <x-slot name="content">
            {{-- Empresa --}}
            <div class="mb-4">
                <x-jet-label class="mb-2">Área</x-jet-label>

                <select wire:model.defer="editForm.area_id" class="w-full input-control">
                    <option value="" disabled>Seleccione un área</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.area_id" />
            </div>

            <div class="mb-4">
                <x-jet-label class="mb-2">Nombre</x-jet-label>
                <x-jet-input wire:model.defer="editForm.nombre" type="text" class="w-full"
                    placeholder="Ingrese el nombre del departamento"></x-jet-input>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.nombre" />
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

        Livewire.on('error', message => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: message,
                showConfirmButton: true,
                confirmButtonColor: '#1f2937',
            });
        });
    </script>
@endpush
