<div class="container py-6">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jornadas de la categoría
                <span class="font-bold">{{ $categoria->nombre }}</span>
            </h2>
            @livewire('categorias-horarios.jornadas.create-jornada', ['categoria' => $categoria], key($categoria->id.'create'))
        </div>
    </x-slot>

    <x-responsive-table>

        {{-- <div class="px-6 py-4 grid grid-cols-6 gap-2">
            Filtros
        </div> --}}

        @if ($items->count())
            <table class="text-gray-600 min-w-full divide-y divide-gray-200">
                <thead class="border-b border-gray-300 bg-gray-200">
                    <tr class="text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Tipo</th>
                        <th class="px-6 py-3">Dia</th>
                        <th class="px-6 py-3">Hora de entrada</th>
                        <th class="px-6 py-3">Hora de salida</th>
                        <th class="px-6 py-3">Tolerancia</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($items as $item)
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 text-sm text-center">{{ $item->nombre }}</td>
                            <td class="px-6 py-4 text-sm text-center">{{ $item->tipo }}</td>
                            <td class="px-6 py-4 text-sm text-center">{{ $item->dia }}</td>
                            <td class="px-6 py-4 text-sm text-center">{{ $item->hora_entrada }}</td>
                            <td class="px-6 py-4 text-sm text-center">{{ $item->hora_salida }}</td>
                            <td class="px-6 py-4 text-sm text-center">{{ $item->tolerancia }}</td>

                            <td class="px-3 py-3 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center justify-center gap-2">
                                    @livewire('categorias-horarios.jornadas.edit-jornada', ['jornada' => $item], key($item->id.'edit'))
                                    {{-- @livewire('items.show-item', ['itemShow' => $item], key($item->id.'show'))
                                    <x-jet-danger-button wire:click="$emit('deleteitem', '{{ $item->id }}')">
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
