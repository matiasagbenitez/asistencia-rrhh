<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

    {{-- TÍTULO --}}
    <div class="flex items-center justify-center gap-3">
        <i class="fas fa-calendar text-2xl"></i>
        <h1 class="text-2xl uppercase font-bold text-center">Calendario maestro</h1>
    </div>

    {{-- FILTROS --}}
    <div class="flex gap-3 my-3">
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
    <div class="grid grid-cols-7 gap-1">
        @foreach ($daysNames as $name)
            <div class="text-center font-bold p-4 uppercase">
                {{ $name }}
            </div>
        @endforeach
    </div>

    {{-- DÍAS --}}
    <div class="grid grid-cols-7 gap-3">
        @foreach ($days as $day)
            @if (empty($day['day']))
                <div class="aspect-square flex justify-center items-center">
                    {{ $day['day'] }}
                </div>
            @else
                <div class="aspect-square justify-center items-center bg-slate-100 hover:bg-slate-200 hover:scale-150 hover:text-xs p-3 rounded-lg">
                    <p class="text-center font-bold mb-2">{{ $day['day'] }}</p>

                    @foreach ($day['events'] as $event)
                        <div class="bg-slate-300 p-1 mb-1 rounded-md">
                            <span>
                                {{ $event }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>

</div>
