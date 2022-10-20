<div>
    <x-jet-button wire:click="editArea">
        <i class="fas fa-edit"></i>
    </x-jet-button>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            Editar area
        </x-slot>

        <x-slot name="content">
            {{-- Name --}}
            <div class="mb-4">
                <x-jet-label class="mb-2">Empresa</x-jet-label>

                <select wire:model.defer="createForm.empresa_id" class="w-full input-control">
                    <option value="" disabled>Seleccione una empresa</option>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="createForm.empresa_id" />
            </div>

            <div class="mb-4">
                <x-jet-label class="mb-2">Nombre</x-jet-label>
                <x-jet-input wire:model.defer="editForm.nombre" type="text" class="w-full"
                    placeholder="Ingrese el nombre del area"></x-jet-input>
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
