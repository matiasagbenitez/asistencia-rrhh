<div class="container py-6">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Informes</h2>
        </div>
    </x-slot>

    <h2 class="font-bold text-lg uppercase">Datos:</h2>
    <hr>
    <div class="flex items-baseline space-x-2">
        <h3 class="mt-3 text-md font-bold">Horas trabajadas:</h3>
        <p class="text-md font-mono">{{ $horasTrabajadas }}</p>
    </div>
    <div class="flex items-baseline space-x-2">
        <h3 class="mt-3 text-md font-bold">Horas Extras:</h3>
        <p class="text-md font-mono">{{ $horasExtras }}</p>
    </div>
    <div class="flex items-baseline space-x-2">
        <h3 class="mt-3 text-md font-bold">Faltas injustificadas:</h3>
        <p class="text-md font-mono">{{ $faltasInjustificadas }}</p>
    </div>
    <div class="flex items-baseline space-x-2">
        <h3 class="mt-3 text-md font-bold">Faltas justificadas:</h3>
        <p class="text-md font-mono">{{ $faltasJustificadas }}</p>
    </div>

</div>
