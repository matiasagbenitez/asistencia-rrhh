<div class="px-8 py-5 bg-white border-b border-gray-200">

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Calendario maestro</h2>
        </div>
    </x-slot>

    {{-- FILTROS --}}
    <div class="flex gap-3 my-2">
        <div class="w-1/2">
            <select wire:model="selectedMonth" class="input-control w-full">
                @foreach ($months as $month => $name)
                    <option value="{{ $month }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-1/2">
            <select wire:model="selectedYear" class="input-control w-full">
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- NOMBRES DE LOS DÍAS --}}
    <div class="grid grid-cols-7 gap-1 bg-gray-400 my-3 rounded-md">
        @foreach ($daysNames as $name)
            <div class="text-center font-bold py-2 uppercase">
                {{ $name }}
            </div>
        @endforeach
    </div>

    {{-- DÍAS --}}
    <div class="grid grid-cols-7 gap-3">
        @foreach ($days as $day)
            @if (empty($day['day']))
                <div class="aspect-auto flex justify-center items-center">
                    {{ $day['day'] }}
                </div>
            @else
                <div
                    class="aspect-auto flex flex-col justify-between bg-gray-100 hover:bg-gray-200 hover:scale-150 hover:text-sm p-2 rounded-lg">
                    <p class="text-right text-lg font-bold mb-2">{{ $day['day'] }}</p>
                    <div class="">
                        @foreach ($day['events'] as $event)
                            <div class=" {{
                                isset($event['tipo']) ?
                                    ($event['tipo'] == 'dia_no_laborable' ? 'bg-green-600' : 'bg-gray-400') : ''
                                }}
                                px-2 py-1 mb-1 rounded-md">
                                <span class="text-sm font-bold text-white">
                                    {{ $event['texto'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

</div>
