<div>
    {{-- LOGO --}}
    <div @click.away="open = false"
        class="flex flex-col flex-shrink-0 w-full text-gray-700 bg-white h-full md:w-60 dark-mode:text-gray-200 dark-mode:bg-gray-800"
        x-data="{ open: false }">
        <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
            <a href="{{ route('dashboard') }}"
                class="text-3xl font-extrabold text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline text-center">
                <div class="">
                    ASISTENCIA
                </div>
            </a>
            <br>
            <br><br>
            <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        {{-- NAVBAR --}}
        <nav :class="{ 'block': open, 'hidden': !open }"
            class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">

            {{-- SUBTÍTULO PARAMETRIZACIÓN --}}
            <span class="font-bold">Parametrización
                <hr>
            </span>

            <a href="#"
                class="block px-4 py-1 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <i class="fas fa-poll mr-2"></i>
                Empresa
            </a>

            <a href="#"
                class="block px-4 py-1 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <i class="fas fa-poll mr-2"></i>
                Áreas
            </a>

            <a href="#"
                class="block px-4 py-1 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <i class="fas fa-poll mr-2"></i>
                Departamentos
            </a>

            <a href="#"
                class="block px-4 py-1 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <i class="fas fa-poll mr-2"></i>
                Puestos
            </a>

        </nav>
    </div>
</div>
