<div class="container py-6">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Puestos de la empresa</h2>
            @livewire('puestos.create-puesto')
        </div>
    </x-slot>

    <x-responsive-table>

        <div class="px-6 py-4 grid grid-cols-8 gap-2">
            <div class="col-span-4">
                <x-jet-input type="text" wire:model="search" class="w-full" placeholder="Filtre su búsqueda aquí..." />
            </div>
            <div class="col-span-2">
                <select wire:model="departamento" class="input-control w-full">
                    <option value="">Seleccione departamento</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->nombre }}">{{ $departamento->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-2">
                <select wire:model="area" class="input-control w-full">
                    <option value="">Seleccione área</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->nombre }}">{{ $area->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @if ($puestos->count())
            <table class="text-gray-600 min-w-full divide-y divide-gray-200">
                <thead class="border-b border-gray-300 bg-gray-200">
                    <tr class="text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                        <th scope="col" class="px-4 py-2 ">
                            ID
                        </th>
                        <th scope="col" class="w-1/3 px-4 py-2">
                            Nombre
                        </th>
                        <th scope="col" class="w-1/3 px-4 py-2">
                            Departamento
                        </th>
                        <th scope="col" class="w-1/3 px-4 py-2">
                            Área
                        </th>
                        <th scope="col" class="px-4 py-2">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($puestos as $puesto)
                        <tr class="bg-gray-50">
                            <td class="px-6 py-3">
                                <p class="text-sm uppercase">
                                    {{ $puesto->id }}
                                </p>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <p class="text-sm uppercase">
                                    {{ $puesto->nombre }}
                                </p>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <p class="text-sm uppercase">
                                    {{ $puesto->departamento->nombre }}
                                </p>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <p class="text-sm uppercase">
                                    {{ $puesto->departamento->area->nombre }}
                                </p>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center justify-center gap-2">
                                    @livewire('puestos.edit-puesto', ['puesto' => $puesto], key($puesto->id))
                                    <x-jet-danger-button
                                        wire:click="$emit('deletePuesto', '{{ $puesto->id }}')">
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

        @if ($puestos->hasPages())
            <div class="px-6 py-3">
                {{ $puestos->links() }}
            </div>
        @endif

    </x-responsive-table>

    @push('script')
        <script>
            Livewire.on('deletePuesto', puestoId => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1f2937',
                    cancelButtonColor: '#dc2626',
                    confirmButtonText: 'Sí, eliminar puesto',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('puestos.index-puestos', 'delete', puestoId);

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
