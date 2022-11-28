<div class="container">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notificaciones') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto px-6 py-4 mt-12 bg-white rounded-lg shadow-lg">
        <h1 class="text-lg font-bold">Listado de notificaciones</h1>
        <hr class="my-3">

        @forelse ($notificaciones as $notificacion)
            <div
                class="p-3 border flex justify-between hover:shadow cursor-pointer border-gray-100 my-3 rounded-lg {{ $notificacion->read_at == null ? 'bg-gray-100' : 'bg-white' }}">

                @switch($notificacion->type)
                    @case('App\Notifications\NotificacionSolicitudIncidencia')
                        <div>
                            <p class="text-gray-600 font-bold">
                                {{ $notificacion->data['empleado'] }} solicitó una incidencia de tipo <span
                                    class="uppercase">{{ $notificacion->data['tipo_de_incidencia'] }}</span>
                            </p>
                            <p class="text-gray-400 text-sm">{{ $notificacion->created_at->diffForHumans() }}</p>
                        </div>
                        <div>
                            <a href="{{ route('empleados.incidencias.index', $notificacion->data['empleado_id']) }}">
                                <x-jet-button>
                                    Ver solicitud
                                </x-jet-button>
                            </a>
                        </div>
                    @break

                    @case('App\Notifications\NotificacionIncidenciaAceptada')
                        <div>
                            <p class="text-gray-600 font-bold">
                                Tu solicitud de incidencia fue aceptada
                                </span>
                            </p>
                            <p class="text-gray-400 text-sm">{{ $notificacion->created_at->diffForHumans() }}</p>
                        </div>
                        <div>
                            <a href="{{ route('empleados.incidencias.index', $notificacion->data['empleado_id']) }}">
                                <x-jet-button>
                                    Ver solicitud
                                </x-jet-button>
                            </a>
                        </div>
                    @break

                    @default
                @endswitch
            </div>
            @empty
                <p>No hay notificaciones nuevas</p>
            @endforelse

        </div>
    </div>
