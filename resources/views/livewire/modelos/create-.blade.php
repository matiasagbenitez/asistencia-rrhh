<div>
    <x-jet-secondary-button wire:click="createItem">
        <i class="fas fa-plus mr-2"></i>
        Crear nueva Item
    </x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            Crear nueva Item
        </x-slot>

        <x-slot name="content">
            Form
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-end gap-3">
                <x-jet-danger-button wire:click="$set('isOpen', false)">
                    Cancelar
                </x-jet-danger-button>

                <x-jet-button wire:click="save">
                    Crear Item
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
