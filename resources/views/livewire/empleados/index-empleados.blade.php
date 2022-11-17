<div class="container py-6">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Empleados</h2>
            @livewire('empleados.create-empleado')
        </div>
    </x-slot>

    <x-responsive-table>

        <div class="px-6 py-4 grid grid-cols-6 gap-2">
            <div class="col-span-6">
                <x-jet-input type="text" wire:model="filters.search" class="w-full"
                    placeholder="Filtre su búsqueda aquí..." />
            </div>

            <div class="col-span-2">
                <select wire:model="filters.area" class="input-control w-full">
                    <option value="">Seleccione un área</option>
                    @foreach ($collections['areas'] as $area)
                        <option value="{{ $area['id'] }}">{{ $area['nombre'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-2">
                <select wire:model="filters.departamento" class="input-control w-full">
                    <option value="">Seleccione un departamento</option>
                    @foreach ($collections['departamentos'] as $departamento)
                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-2">
                <select wire:model="filters.puesto" class="input-control w-full">
                    <option value="">Seleccione un puesto</option>
                    @foreach ($collections['puestos'] as $puesto)
                        <option value="{{ $puesto->id }}">{{ $puesto->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @if ($empleados->count())
            <table class="text-gray-600 min-w-full divide-y divide-gray-200">
                <thead class="border-b border-gray-300 bg-gray-200">
                    <tr class="text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                        <th scope="col" class="px-4 py-2 ">
                            ID
                        </th>
                        <th scope="col" class="w-1/4 px-4 py-2">
                            Empleado
                        </th>
                        <th scope="col" class="w-1/4 px-4 py-2">
                            Area
                        </th>
                        <th scope="col" class="w-1/4 px-4 py-2">
                            Departamento
                        </th>
                        <th scope="col" class="w-1/4 px-4 py-2">
                            Puesto
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($empleados as $empleado)
                        <tr onclick="window.location='{{ route('empleados.detalle', $empleado)}}';" class="bg-gray-50 hover:bg-gray-200 cursor-pointer hover:font-bold" title="Click para ir a detalle de empleado">
                            <td class="px-3 py-3">
                                <p class="text-sm uppercase">
                                    {{ $empleado->id }}
                                </p>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <p class="text-sm uppercase">
                                    {{ $empleado->nombre }} {{ $empleado->apellido }}
                                </p>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <p class="text-sm uppercase">
                                    {{ $empleado->area }}
                                </p>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <p class="text-sm uppercase">
                                    {{ $empleado->departamento }}
                                </p>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <p class="text-sm uppercase">
                                    {{ $empleado->puesto }}
                                </p>
                            </td>
                            {{-- <td class="px-3 py-3 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center justify-center gap-2">
                                    @livewire('empleados.show-empleado', ['empleadoShow' => $empleado], key($empleado->id . 'show'))

                                    <x-jet-danger-button wire:click="$emit('deleteEmpleado', '{{ $empleado->id }}')">
                                        <i class="fas fa-trash"></i>
                                    </x-jet-danger-button>
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-4">
                <p class="text-center font-semibold">No se encontraron registros coincidentes.</p>
            </div>
        @endif

        @if ($empleados->hasPages())
            <div class="px-6 py-3">
                {{ $empleados->links() }}
            </div>
        @endif

    </x-responsive-table>

    {{-- @push('script')
        <script>
            Livewire.on('deleteEmpleado', empleadoId => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1f2937',
                    cancelButtonColor: '#dc2626',
                    confirmButtonText: 'Sí, eliminar empleado',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('empleados.index-empleados', 'delete', empleadoId);

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
    @endpush --}}

</div>
