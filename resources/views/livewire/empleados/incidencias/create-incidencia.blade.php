<div>
    <x-jet-secondary-button wire:click="createIncidencia">
        <i class="fas fa-plus mr-2"></i>
        @if (Auth::user()->can('empleados'))
            Registrar nueva incidencia
        @else
            Solicitar nueva incidencia
        @endif
    </x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title" class="font-semibold">
            @if (Auth::user()->can('empleados'))
                Registrar nueva incidencia
            @else
                Solicitar nueva incidencia
            @endif
        </x-slot>

        <x-slot name="content">
            @include('livewire.empleados.incidencias.form-incidencia')
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-end gap-3">
                <x-jet-danger-button wire:click="$set('isOpen', false)">
                    Cancelar
                </x-jet-danger-button>

                <x-jet-button wire:click="save">
                    Crear incidencia
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
