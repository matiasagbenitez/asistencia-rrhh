<div class="container py-6">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tipos de incidencias</h2>
            @livewire('tipos-de-incidencia.create-tipo-de-incidencia')
        </div>
    </x-slot>

    <x-responsive-table>

        <div class="px-6 py-4 flex gap-2">
            <x-jet-input type="text" wire:model="search" class="w-full" placeholder="Filtre su búsqueda aquí..." />
        </div>

        @if ($tipos_de_incidencia->count())
            <table class="text-gray-600 min-w-full divide-y divide-gray-200">
                <thead class="border-b border-gray-300 bg-gray-200">
                    <tr class="text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                        <th scope="col" class="px-4 py-2 ">
                            ID
                        </th>
                        <th scope="col" class="w-1/2 px-4 py-2">
                            Nombre tipo de incidencia
                        </th>
                        <th scope="col" class="w-1/2 px-4 py-2">
                            Descuenta sueldo
                        </th>
                        <th scope="col" class="px-4 py-2">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($tipos_de_incidencia as $tipo)
                        <tr class="bg-gray-50">
                            <td class="px-6 py-3">
                                <p class="text-sm uppercase">
                                    {{ $tipo->id }}
                                </p>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <p class="text-sm uppercase">
                                    {{ $tipo->nombre }}
                                </p>
                            </td>
                            <td class="px-6 py-3 text-center">
                                @switch($tipo->descuenta_sueldo)
                                    @case(0)
                                        <div class="flex items-center justify-center">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                No descuenta
                                            </span>
                                        </div>
                                    @break

                                    @case(1)
                                        <div class="flex items-center justify-center">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Descuenta sueldo
                                            </span>
                                        </div>
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center justify-center gap-2">
                                    @livewire('tipos-de-incidencia.edit-tipo-de-incidencia', ['tipo' => $tipo], key($tipo->id))
                                    <x-jet-danger-button
                                        wire:click="$emit('deleteTipoDeIncidencia', '{{ $tipo->id }}')">
                                        <i class="fas fa-trash"></i>
                                    </x-jet-danger-button>
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

        @if ($tipos_de_incidencia->hasPages())
            <div class="px-6 py-3">
                {{ $tipos_de_incidencia->links() }}
            </div>
        @endif

    </x-responsive-table>

    @push('script')
        <script>
            Livewire.on('deleteTipoDeIncidencia', TipoDeIncidenciaId => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1f2937',
                    cancelButtonColor: '#dc2626',
                    confirmButtonText: 'Sí, eliminar tipo de incidencia',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('tipos-de-incidencia.index-tipos-de-incidencia', 'delete',
                            TipoDeIncidenciaId);

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
