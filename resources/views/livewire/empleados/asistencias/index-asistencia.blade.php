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
                Asistencias de
                <span class="font-bold uppercase">{{ $empleado->nombre }} {{ $empleado->apellido }}</span>
            </h2>
            @livewire('empleados.asistencias.create-asistencia', ['empleado' => $empleado], key($empleado->id))
        </div>
    </x-slot>

    <x-responsive-table>

        @if ($items->count())
            <table class="text-gray-600 min-w-full divide-y divide-gray-200">
                <thead class="border-b border-gray-300 bg-gray-200">
                    <tr class="text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                        <th class="w-1/2 px-6 py-3">Entrada</th>
                        <th class="w-1/2 px-6 py-3">Salida</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($items as $item)
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 text-sm text-center">{{ Date::parse($item->fecha_hora_entrada)->format('d-m-Y H:i') }} HS</td>
                            <td class="px-6 py-4 text-sm text-center">{{ Date::parse($item->fecha_hora_salida)->format('d-m-Y H:i') }} HS</td>
                            <td class="px-3 py-3 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center justify-center gap-2">
                                    @livewire('empleados.asistencias.edit-asistencia', ['asistencia' => $item], key($item->id.'edit'))
                                    <x-jet-danger-button wire:click="$emit('deleteAsistencia', '{{ $item->id }}')">
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
                    No se encontraron registros de asistencia de
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
            Livewire.on('deleteHoraExtra', itemId => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1f2937',
                    cancelButtonColor: '#dc2626',
                    confirmButtonText: 'Sí, eliminar hora extra',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('empleados.asistencias.index-asistencia', 'delete', itemId);

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
