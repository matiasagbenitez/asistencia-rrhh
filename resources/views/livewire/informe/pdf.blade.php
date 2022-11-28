<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body>
        <div class="container py-6">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Informes de asistencias</h2>
        </div>
    </x-slot>

    <div class="px-8 py-6 mt-6 bg-white rounded-lg shadow">
        @if (isset($stats))
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
                {{ Date::parse($fecha_inicio)->format('d-m-Y') }} y
                {{ Date::parse($fecha_fin)->format('d-m-Y') }}.
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
    </body>
</html>
