<div>
    <x-jet-button wire:click="edit">
        <i class="fas fa-edit"></i>
    </x-jet-button>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            Editar empresa
        </x-slot>

        <x-slot name="content">
            {{-- Name --}}
            <div class="mb-4">
                <x-jet-label class="mb-2">Nombre</x-jet-label>
                <x-jet-input wire:model.defer="editForm.nombre" type="text" class="w-full"
                    placeholder="Ingrese el nombre de la empresa"></x-jet-input>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.nombre" />
            </div>

            {{-- Name --}}
            <div class="mb-4">
                <x-jet-label class="mb-2">CUIT</x-jet-label>
                <x-jet-input wire:model.defer="editForm.cuit" type="text" class="w-full"
                    placeholder="Ingrese el CUIT de la empresa"></x-jet-input>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.cuit" />
            </div>

            {{-- Name --}}
            <div class="mb-4">
                <x-jet-label class="mb-2">Razón social</x-jet-label>
                <x-jet-input wire:model.defer="editForm.razon_social" type="text" class="w-full"
                    placeholder="Ingrese la razón social de la empresa"></x-jet-input>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.razon_social" />
            </div>

            {{-- Name --}}
            <div class="mb-4">
                <x-jet-label class="mb-2">Dirección</x-jet-label>
                <x-jet-input wire:model.defer="editForm.direccion" type="text" class="w-full"
                    placeholder="Ingrese la dirección de la empresa"></x-jet-input>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="editForm.direccion" />
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
