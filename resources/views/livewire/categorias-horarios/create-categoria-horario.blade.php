<div>
    <x-jet-secondary-button wire:click="createCategoriaHorario">
        <i class="fas fa-plus mr-2"></i>
        Crear nueva categoría de horario
    </x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            Crear nueva categoría de horario
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label class="mb-2">Nombre</x-jet-label>
                <x-jet-input wire:model.defer="createForm.nombre" type="text" class="w-full"
                    placeholder="Ingrese el nombre de la categoría de horario"></x-jet-input>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="createForm.nombre" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-end gap-3">
                <x-jet-danger-button wire:click="$set('isOpen', false)">
                    Cancelar
                </x-jet-danger-button>

                <x-jet-button wire:click="save">
                    Crear categoría de horario
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
