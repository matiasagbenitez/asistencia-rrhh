<div>
    <x-jet-secondary-button wire:click="createArea">
        <i class="fas fa-plus mr-2"></i>
        Crear nueva area
    </x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            Crear nueva area
        </x-slot>

        <x-slot name="content">
            {{-- Empresa --}}
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
                <x-jet-input wire:model.defer="createForm.nombre" type="text" class="w-full"
                    placeholder="Ingrese el nombre del área"></x-jet-input>
                <x-jet-input-error class="mt-2 text-xs font-semibold" for="createForm.nombre" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-end gap-3">
                <x-jet-danger-button wire:click="$set('isOpen', false)">
                    Cancelar
                </x-jet-danger-button>

                <x-jet-button wire:click="save">
                    Crear area
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
