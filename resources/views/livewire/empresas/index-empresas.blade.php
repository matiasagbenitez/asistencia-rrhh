<div class="container py-6">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Empresa</h2>
            {{-- @livewire('areas.create-area') --}}
        </div>
    </x-slot>

    <x-responsive-table>

        <table class="text-gray-600 min-w-full divide-y divide-gray-200">
            <thead class="border-b border-gray-300 bg-gray-200">
                <tr class="text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                    <th scope="col"
                        class="px-4 py-2">
                        ID
                    </th>
                    <th scope="col"
                        class="w-1/4 py-2">
                        Nombre
                    </th>
                    <th scope="col"
                        class="w-1/4 py-2">
                        CUIT
                    </th>
                    <th scope="col"
                        class="w-1/4 py-2">
                        Razón social
                    </th>
                    <th scope="col"
                        class="w-1/4 py-2">
                        Dirección
                    </th>
                    <th scope="col"
                        class="px-4 py-2">
                        Acción
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($empresas as $empresa)
                    <tr class="bg-gray-50">
                        <td class="px-6 py-3">
                            <p class="text-sm uppercase">
                                {{ $empresa->id }}
                            </p>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-center">
                            <p class="text-sm uppercase">
                                {{ $empresa->nombre }}
                            </p>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-center">
                            <p class="text-sm uppercase">
                                {{ $empresa->cuit }}
                            </p>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-center">
                            <p class="text-sm uppercase">
                                {{ $empresa->razon_social }}
                            </p>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-center">
                            <p class="text-sm uppercase">
                                {{ $empresa->direccion }}
                            </p>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center justify-center gap-2">
                                @livewire('empresas.editar-empresa', ['empresa' => $empresa], key($empresa->id))
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </x-responsive-table>

</div>
