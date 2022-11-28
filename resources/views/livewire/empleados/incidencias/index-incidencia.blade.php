<div class="container py-6">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="{{ route('empleados.detalle', $empleado) }}">
                <x-jet-button>
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver
                </x-jet-button>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Incidencias de
                <span class="font-bold uppercase">{{ $empleado->nombre }} {{ $empleado->apellido }}</span>
            </h2>
            @livewire('empleados.incidencias.create-incidencia', ['empleado' => $empleado], key($empleado->id))
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
                        {{-- <th class="px-6 py-3">ID</th> --}}
                        <th class="w-1/5 px-6 py-3">Inicio incidencia</th>
                        <th class="w-1/3 px-6 py-3">Incidencia</th>
                        <th class="w-1/5 px-6 py-3">Fin incidencia</th>
                        <th class="w-1/5 px-6 py-3">Descuenta sueldo</th>
                        <th class="w-1/5 px-6 py-3">Estado</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($items as $item)
                        <tr class="bg-gray-50 uppercase text-sm">
                            {{-- <td class="px-6 py-4 text-center">{{ $item->id }}</td> --}}
                            <td class="px-6 py-4 text-center">{{ Date::parse($item->fecha_hora_inicio )->format('d-m-Y H:i') }} hs</td>
                            <td class="px-6 py-4 text-center">{{ $item->tipo }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($item->fecha_hora_fin)
                                    {{ Date::parse($item->fecha_hora_fin )->format('d-m-Y H:i') }} hs
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if (!$item->tipoDeIncidencia->descuenta_sueldo)
                                <span
                                    class="px-6 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    NO DESCUENTA
                                </span>
                            @else
                                <span
                                    class="px-6 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    DESCUENTA
                                </span>
                            @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{
                                    $item->aprobado
                                    ? "Aprobado"
                                    : "Pendiente"
                                }}
                            </td>
                            <td class="px-3 py-3 normal-case">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- @livewire('items.show-item', ['itemShow' => $item], key($item->id.'show')) --}}
                                    @can('empleados')
                                        @if (!$item->aprobado)
                                            <x-jet-button class="bg-green-600" wire:click="aprobar({{ $item->id }})">
                                                <i class="fas fa-check mr-2"></i>
                                                Aprobar
                                            </x-jet-danger-button>
                                        @endif
                                        @livewire('empleados.incidencias.edit-incidencia', ['incidencia' => $item], key($item->id.'edit'))
                                    @endcan
                                    <x-jet-danger-button wire:click="$emit('deleteItem', '{{ $item->id }}')">
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
                <p class="text-center font-semibold">
                    No se encontraron incidencias para
                    <span class="font-bold">
                        {{ $empleado->nombre }} {{ $empleado->apellido }}.
                    </span>
                </p>
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
            Livewire.on('deleteItem', itemId => {
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

                        Livewire.emitTo('empleados.incidencias.index-incidencia', 'delete', itemId);

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
