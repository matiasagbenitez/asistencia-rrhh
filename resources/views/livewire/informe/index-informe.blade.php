<div class="container py-6">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Informes de asistencias</h2>
            {{-- PDF BUTTON --}}
            <a href="#">
                <x-jet-danger-button>
                    <i class="fas fa-file-pdf mr-2"></i>
                    Descargar PDF
                </x-jet-danger-button>
            </a>
        </div>
    </x-slot>

    <div class="px-6 py-4 grid grid-cols-6 gap-2">
        <div class="col-span-2">
            <x-jet-label class="mb-2">Empleado</x-jet-label>
            <select wire:model="filtros.empleado_id" class="input-control w-full">
                <option value="">Seleccione un empleado</option>
                @foreach ($collections['empleados'] as $empleado)
                    <option value="{{ $empleado['id'] }}">{{ $empleado['nombre'] }} {{ $empleado['apellido'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-2">
            <x-jet-label class="mb-2">Fecha de inicio</x-jet-label>
            <x-jet-input wire:model="filtros.fecha_inicio" type="date" class="w-full">
            </x-jet-input>
            <x-jet-input-error class="mt-2 text-xs font-semibold" for="filtros.fecha_inicio" />
        </div>
        <div class="col-span-2">
            <x-jet-label class="mb-2">Fecha de fin</x-jet-label>
            <x-jet-input wire:model="filtros.fecha_fin" type="date" class="w-full">
            </x-jet-input>
            <x-jet-input-error class="mt-2 text-xs font-semibold" for="filtros.fecha_fin" />
        </div>
    </div>

    <div class="px-8 py-6 mt-6 bg-white rounded-lg shadow">
        @if ($stats)
            <h1 class="font-bold text-lg uppercase">Informe de asistencias</h1>
            <hr class="my-2">

            <div class="flex justify-between my-2">
                <p class="font-bold">Empleado: <span class="font-normal">{{ $stats['empleado']->nombre }}
                        {{ $stats['empleado']->apellido }}</span></p>
                <p class="font-bold">CUIL: <span class="font-normal">{{ $stats['empleado']->cuil }}</span></p>
                <p class="font-bold">Fecha emisión: <span
                        class="font-normal">{{ Date::parse(now())->format('d-m-Y') }}</span></p>
            </div>

            <div class="flex flex-col gap-2 mb-5">
                <p class="font-bold">Puesto: <span class="font-normal">{{ $stats['empleado']->puesto->nombre }}</span>
                </p>
                <p class="font-bold">Deparmento: <span
                        class="font-normal">{{ $stats['empleado']->puesto->departamento->nombre }}</span></p>
                <p class="font-bold">Area: <span
                        class="font-normal">{{ $stats['empleado']->puesto->departamento->area->nombre }}</span></p>
            </div>


            <h1 class="font-bold text-lg uppercase">Detalle del informe</h1>
            <hr class="my-2">

            <span class="text-sm text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                El presente reporte toma en consideración las asistencias registradas en el sistema entre las fechas
                {{ Date::parse($filtros['fecha_inicio'])->format('d-m-Y') }} y
                {{ Date::parse($filtros['fecha_fin'])->format('d-m-Y') }}.
            </span>

            {{-- ------------------------------------------------ LISTADO DE ASISTENCIAS ----------------------------------------------------------- --}}
            <h2 class="my-2 font-bold">Listado de asistencias registradas</h2>
            @if ($stats['asistencias'])
                <div class="rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-100 border">
                        <thead class="border-b border-gray-100 bg-gray-100">
                            <tr class="text-center text-sm font-bold uppercase tracking-wider">
                                <th class="px-2 py-2 w-1/4">Tipo</th>
                                <th class="px-2 py-2 w-1/4">Fecha</th>
                                <th class="px-2 py-2 w-1/4">Hora de inicio</th>
                                <th class="px-2 py-2 w-1/4">Hora de fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stats['listado_asistencias'] as $item)
                                <tr class="{{ $item['tipo'] != 'asistencia' ? 'bg-red-100 font-bold' : '' }}">
                                    <td class="py-2 px-2 text-center">
                                        <p class="text-sm uppercase">
                                            {{ $item['tipo'] }}
                                        </p>
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <p class="text-sm uppercase">
                                            {{ Date::parse($item['fecha_hora_entrada'])->format('d-m-Y') }}
                                        </p>
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <p class="text-sm uppercase">
                                            {{ Date::parse($item['fecha_hora_entrada'])->format('H:i') }}
                                        </p>
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <p class="text-sm uppercase">
                                            {{ $item['fecha_hora_fin'] ? Date::parse($item['fecha_hora_fin'])->format('H:i') : ' - - ' }}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="border-gray-100 bg-gray-100 text-center font-bold uppercase text-sm">
                                <td></td>
                                <td class="py-2">Total horas trabajadas</td>
                                <td></td>
                                <td class="py-2">{{ number_format($stats['horasTrabajadas'], 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4">
                    <p class="text-sm text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        No se encontraron asistencias registradas en el sistema.
                    </p>
                </div>
            @endif
            {{-- ---------------------------------------------- FIN LISTADO DE ASISTENCIAS --------------------------------------------------------- --}}

            <br>

            {{-- ------------------------------------------------ LISTADO DE HORAS EXTRA ----------------------------------------------------------- --}}
            <h2 class="my-2 font-bold">Listado de horas extra</h2>
            @if ($stats['horasExtras'])
                <div class="rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-100 border">
                        <thead class="border-b border-gray-100 bg-gray-100">
                            <tr class="text-center text-sm font-bold uppercase tracking-wider">
                                <th class="px-2 py-2 w-1/4">Fecha</th>
                                <th class="px-2 py-2 w-1/4">Entrada</th>
                                <th class="px-2 py-2 w-1/4">Salida</th>
                                <th class="px-2 py-2 w-1/4">Horas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stats['listado_horas_extra'] as $horaExtra)
                                <tr>
                                    <td class="py-2 px-2 text-center">
                                        <p class="text-sm uppercase">
                                            {{ Date::parse($horaExtra->fecha_hora_inicio)->format('d-m-Y') }}
                                        </p>
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <p class="text-sm uppercase">
                                            {{ Date::parse($horaExtra->fecha_hora_inicio)->format('H:i') }}
                                        </p>
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <p class="text-sm uppercase">
                                            {{ Date::parse($horaExtra->fecha_hora_fin)->format('H:i') }}
                                        </p>
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <p class="text-sm uppercase">
                                            {{ number_format($horaExtra->cantidad_horas, 2) }}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="border-gray-100 bg-gray-100 text-center font-bold uppercase text-sm">
                                <td></td>
                                <td class="py-2">Total horas extras</td>
                                <td></td>
                                <td class="py-2">{{ number_format($stats['horasExtras'], 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4">
                    <p class="text-sm text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        No se encontraron horas extras registradas en el sistema.
                    </p>
                </div>
            @endif
            {{-- ---------------------------------------------- FIN LISTADO DE HORAS EXTRA --------------------------------------------------------- --}}

            <br>

            {{-- ------------------------------------------ ESTADÍSTICAS ASISTENCIAS Y FALTAS ------------------------------------------------------ --}}
            <div class="grid grid-cols-2 gap-4 mt-2 rounded-lg overflow-hidden">
                <div class="border p-4 rounded-lg h-96">
                    <h2 class="font-bold text-center">Faltas justificadas e injustificadas</h2>
                    @if ($emptyData['faltas'])
                        <div class="p-4 flex my-auto justify-center">
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                No se encontraron faltas registradas en el sistema.
                            </p>
                        </div>
                    @else
                        {!! $faltasChart->container() !!}
                        {!! $faltasChart->script() !!}
                    @endif
                </div>
                <div class="border p-4 rounded-lg h-96">
                    <h2 class="font-bold text-center">Asistencias y faltas</h2>
                    @if ($emptyData['asistencias'])
                        <div class="p-4 flex my-auto justify-center">
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                No se encontraron asistencias ni faltas registradas en el sistema.
                            </p>
                        </div>
                    @else
                        {!! $asistenciasChart->container() !!}
                        {!! $asistenciasChart->script() !!}
                    @endif
                </div>
                <div class="col-span-2 border p-4 rounded-lg">
                    <h2 class="font-bold text-center">Horas extras anualizadas</h2>
                    {!! $horasExtrasChart->container() !!}
                    {!! $horasExtrasChart->script() !!}
                </div>
            </div>
            {{-- ---------------------------------------- FIN ESTADÍSTICAS ASISTENCIAS Y FALTAS ---------------------------------------------------- --}}
            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Asistencias:</h3>
                <p class="text-md font-mono">{{ $stats['asistencias'] }}</p>
            </div>
            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Faltas injustificadas:</h3>
                <p class="text-md font-mono">{{ $stats['faltasInjustificadas'] }}</p>
            </div>
            <div class="flex items-baseline space-x-2">
                <h3 class="mt-3 text-md font-bold">Faltas justificadas:</h3>
                <p class="text-md font-mono">{{ $stats['faltasJustificadas'] }}</p>
            </div>
        @else
            Seleccione un empleado para ver sus estadísticas.
        @endif
    </div>
</div>
