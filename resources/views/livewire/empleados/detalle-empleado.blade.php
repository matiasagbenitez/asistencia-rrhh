<div class="container py-6">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            {{-- GO BACK BUTTON --}}
            <a href="{{ route('empleados.index') }}">
                <x-jet-button>
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver
                </x-jet-button>
            </a>

            <h1 class="text-xl font-bold">{{ $empleado->nombre }} {{ $empleado->apellido }}</span></h1>

            {{-- PDF BUTTON --}}
            <a href="#">
                <x-jet-danger-button>
                    <i class="fas fa-file-pdf mr-2"></i>
                    Descargar PDF
                </x-jet-danger-button>
            </a>
        </div>
    </x-slot>

    {{-- <div class="flex justify-between"> --}}
    <div class="grid grid-cols-4 gap-5">

        <div class="col-span-3 px-8 py-6 mt-6 bg-white rounded-lg shadow">
            <div class="grid grid-cols-5 gap-4">
                {{-- INFORMACIÓN DEL EMPLEADO --}}
                <div class="col-span-5">
                    <div class="grid grid-cols-4">

                        <div class="col-span-4">
                            <div class="flex justify-between">
                                <span class="font-bold uppercase">Información personal</span>
                                @if ($empleado->fecha_egreso != null)
                                    <div class="flex items-center justify-center">
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold uppercase rounded-full bg-red-100 text-red-800">
                                            Empleado inactivo
                                        </span>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center">
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold uppercase rounded-full bg-green-100 text-green-800">
                                            Empleado activo
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <hr class="my-1">
                        </div>

                        {{-- IMAGEN --}}
                        <div class="col-span-1">
                            <img class="h-48 w-48 p-5"
                                src="https://cdn.pixabay.com/photo/2016/11/14/17/39/person-1824147_960_720.png"
                                alt="Imagen usuario">
                        </div>

                        {{-- DATOS --}}
                        <div class="col-span-3 pt-2">
                            <p class="font-bold">Nombre: <span class="font-normal">{{ $empleado->nombre }}</span></p>
                            <p class="font-bold">Apellido: <span class="font-normal">{{ $empleado->apellido }}</span>
                            </p>
                            <p class="font-bold">CUIL: <span class="font-normal">{{ $empleado->cuil }}</span></p>
                            <p class="font-bold">Dirección: <span class="font-normal">{{ $empleado->direccion }}</span>
                            </p>

                        </div>

                        <div class="col-span-4">
                            <span class="font-bold uppercase">Información laboral</span>
                            <hr class="my-1">
                        </div>

                        <div class="col-span-4">
                            <p class="font-bold">Fecha ingreso: <span
                                    class="font-normal">{{ Date::parse($empleado->fecha_ingreso)->format('d-m-Y') }}</span>
                            </p>

                            <p class="font-bold">Puesto: <span
                                    class="font-normal">{{ $empleado->puesto->nombre }}</span>
                            </p>
                            <p class="font-bold">Departamento: <span
                                    class="font-normal">{{ $empleado->puesto->departamento->nombre }}</span></p>
                            <p class="font-bold">Área: <span
                                    class="font-normal">{{ $empleado->puesto->departamento->area->nombre }}</span></p>

                            <p class="font-bold">Fecha egreso:
                                <span class="font-normal">
                                    @if ($empleado->fecha_egreso)
                                        {{ Date::parse($empleado->fecha_egreso)->format('d-m-Y') }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BARRA LATERAL --}}
        <div class="px-8 py-6 mt-6 bg-white rounded-lg shadow">
            <span class="font-bold uppercase">Panel de administración</span>
            <hr class="my-1 mb-3">

            <div class="flex flex-col gap-2">
                @livewire('empleados.edit-empleado', ['empleadoEdit' => $empleado], key($empleado->id . 'edit'))
                <a href="{{ route('empleados.asistencias.index', $empleado->id) }}">
                    <x-jet-button title="Asistencias" class="bg-cyan-900 w-full">
                        {{-- Icon for assistence --}}
                        <i class="fas fa-clipboard mr-3"></i>
                        Asistencias
                    </x-jet-button>
                </a>
                <a href="{{ route('empleados.incidencias.index', $empleado->id) }}">
                    <x-jet-button title="Incidencias" class="bg-cyan-800 w-full">
                        <i class="fas fa-calendar-alt mr-3"></i>
                        Incidencias
                    </x-jet-button>
                </a>
                <a href="{{ route('empleados.horas-extras.index', $empleado->id) }}">
                    <x-jet-button title="Horas extras" class="bg-cyan-700 w-full">
                        <i class="fas fa-clock mr-3"></i>
                        Horas extras
                    </x-jet-button>
                </a>
                <a href="{{ route('informes.index', $empleado->id) }}">
                    <x-jet-button title="Horas extras" class="bg-cyan-600 w-full">
                        <i class="fas fa-database mr-3"></i>
                        Generar informe
                    </x-jet-button>
                </a>
            </div>
        </div>

    </div>

</div>
