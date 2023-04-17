<x-nav.dropdown align="left">
    <x-slot name="trigger">
        <x-nav.nav-link href="#"
            :active="request()->routeIs('test.*')">
            Testeos
        </x-nav.nav-link>
    </x-slot>

    <x-slot name="content">

        <x-nav.dropdown-link href="{{route('test.varios.index')}}">
            Varios
        </x-nav.dropdown-link>

        <div class="border-t border-gray-100"></div>

        <x-nav.dropdown-link {{-- href="{{route('test.reporte.download')}}" --}}>
            Descargar Reporte PDF
        </x-nav.dropdown-link>

        <x-nav.dropdown-link {{-- href="{{route('test.reporte.stream')}}" target="_blank" --}}>
            Ver Reporte PDF
        </x-nav.dropdown-link>

        <div class="border-t border-gray-100"></div>

        <x-nav.dropdown-link {{-- href="{{route('test.chartjs')}}" --}}>
            ChartJS
        </x-nav.dropdown-link>

        <div class="border-t border-gray-100"></div>

        <div class="block px-4 py-2 text-xs text-gray-400">
            ABMs Complementarios
        </div>

        <x-nav.dropdown-link href="#">
            Ejemplo 1
        </x-nav.dropdown-link>

        <x-nav.dropdown-link href="#">
            Ejemplo 2
        </x-nav.dropdown-link>
    </x-slot>
    </x-nav-dropdown>
