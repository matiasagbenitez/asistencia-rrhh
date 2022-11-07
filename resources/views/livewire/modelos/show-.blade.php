<div>
    <x-jet-secondary-button wire:click="showItem">
        <i class="fas fa-eye"></i>
    </x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h1 class="font-bold text-2xl">
                Detalles de Item
            </h1>
        </x-slot>

        <x-slot name="content">
            Mostrar Item
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-end gap-3">
                <x-jet-button wire:click="$set('isOpen', false)">
                    Volver
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
