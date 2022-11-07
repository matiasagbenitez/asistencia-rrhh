<div class="container py-6">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Incidencias</h2>
            @livewire('empleados.incidencias.create-incidencia', ['empleado' => $empleado], key($empleado->id))
        </div>
    </x-slot>

    <x-responsive-table>

        <div class="px-6 py-4 grid grid-cols-6 gap-2">
            Filtros
        </div>

        @if ($items->count())
            <table class="text-gray-600 min-w-full divide-y divide-gray-200">
                <thead class="border-b border-gray-300 bg-gray-200">
                    <tr class="text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3">Id</th>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Tipo</th>
                        <th class="px-6 py-3">Descripción</th>
                        <th class="px-6 py-3">Fecha y hora</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($items as $item)
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 text-center">{{ $item->id }}</td>
                            <td class="px-6 py-4 text-center">{{ $item->nombre }}</td>
                            <td class="px-6 py-4 text-center">{{ $item->tipo }}</td>
                            <td class="px-6 py-4 text-center">{{ $item->descripcion }}</td>
                            <td class="px-6 py-4 text-center">{{ $item->fecha_hora }}</td>
                            <td class="px-3 py-3 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- @livewire('items.show-item', ['itemShow' => $item], key($item->id.'show')) --}}
                                    @livewire('empleados.incidencias.edit-incidencia', ['incidencia' => $item], key($item->id.'edit'))
                                    {{-- <x-jet-danger-button wire:click="$emit('deleteItem', '{{ $item->id }}')">
                                        <i class="fas fa-trash"></i>
                                    </x-jet-danger-button> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-4">
                <p class="text-center font-semibold">No se encontraron registros coincidentes.</p>
            </div>
        @endif

        @if ($items->hasPages())
            <div class="px-6 py-3">
                {{ $items->links() }}
            </div>
        @endif

    </x-responsive-table>

    @push('script')
        <script>
            Livewire.on('deleteitem', itemId => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1f2937',
                    cancelButtonColor: '#dc2626',
                    confirmButtonText: 'Sí, eliminar item',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('items.index-items', 'delete', itemId);

                        Livewire.on('success', message => {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
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
                    }
                })
            });
        </script>
    @endpush
</div>
