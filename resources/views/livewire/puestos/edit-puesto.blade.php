<div>
    <x-jet-button wire:click="editPuesto">
        <i class="fas fa-edit"></i>
    </x-jet-button>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            Editar puesto
        </x-slot>

        <x-slot name="content">
            {{-- Country --}}
            <div class="mb-4">
                <x-jet-label class="mb-2">Área</x-jet-label>
                <select class="input-control w-full" wire:model="editForm.area_id">
                    <option value="" disabled selected>Seleccione el área al que pertenece</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.area_id" />
            </div>

            {{-- Province --}}
            <div class="mb-4">
                <x-jet-label class="mb-2">Departamento</x-jet-label>
                <select class="input-control w-full" wire:model="editForm.departamento_id">
                    <option value="" disabled selected>Seleccione el departamento al que pertenece</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.departamento_id" />
            </div>

            {{-- Name --}}
            <div class="mb-4">
                <x-jet-label class="mb-2">Puesto</x-jet-label>
                <x-jet-input wire:model.defer="editForm.nombre" type="text" class="w-full" placeholder="Ingrese el nombre del puesto"></x-jet-input>
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
    </script>
@endpush
