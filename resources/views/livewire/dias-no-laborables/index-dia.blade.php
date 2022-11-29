<div class="container py-6">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Días no laborables</h2>
            @livewire('dias-no-laborables.create-dias')
        </div>
    </x-slot>

    <x-responsive-table>

        <div class="px-6 py-4 flex gap-2">
            <x-jet-input type="text" wire:model="search" class="w-full" placeholder="Filtre su búsqueda aquí..." />
        </div>

        @if ($dias->count())
            <table class="text-gray-600 min-w-full divide-y divide-gray-200">
                <thead class="border-b border-gray-300 bg-gray-200">
                    <tr class="text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                        <th scope="col"
                            class="px-4 py-2 ">
                            ID
                        </th>
                        <th scope="col"
                            class="px-4 py-2">
                            Nombre
                        </th>
                        <th scope="col"
                            class="px-4 py-2">
                            Fecha
                        </th>
                        <th scope="col"
                            class="px-4 py-2">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($dias as $dia)
                        <tr class="bg-gray-50">
                            <td class="px-6 py-2 text-center">
                                <p class="text-sm uppercase">
                                    {{ $dia->id }}
                                </p>
                            </td>
                            <td class="px-6 py-2 text-center">
                                <p class="text-sm uppercase">
                                    {{ $dia->nombre }}
                                </p>
                            </td>
                            <td class="px-6 py-2 text-center">
                                <p class="text-sm uppercase">
                                    {{ Date::parse($dia->fecha)->format('d-m-Y') }}
                                </p>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center justify-center gap-2">
                                    @livewire('dias-no-laborables.edit-dias', ['dia' => $dia], key($dia->id))
                                    <x-jet-danger-button wire:click="$emit('deleteDia', '{{ $dia->id }}')">
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

    </x-responsive-table>

    @push('script')
        <script>
            Livewire.on('deleteDia', diaId => {
                console.log(diaId);
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1f2937',
                    cancelButtonColor: '#dc2626',
                    confirmButtonText: 'Sí, eliminar día',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('dias-no-laborables.index-dias', 'delete', diaId);

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
