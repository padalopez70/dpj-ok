<x-nav.dropdown align="left">

    <x-slot name="trigger">
        <x-nav.nav-link href="#"
            :active="request()->routeIs('admin.*')">
            Admininistración
        </x-nav.nav-link>
    </x-slot>

    <x-slot name="content">
        <x-nav.dropdown-sub align="left">
            <x-slot name="trigger">
                <x-nav.dropdown-sub-link href="#">
                    Usuarios&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>>
                </x-nav.dropdown-sub-link>
            </x-slot>

            <x-slot name="content">
                <!-- subtitulo -->
                <x-nav.dropdown-link href="{{route('sis.abm-usuario.usuarios.index')}}">
                    Usuarios
                </x-nav.dropdown-link>

                <div class="border-t border-gray-100"></div>

                <x-nav.dropdown-link href="{{route('sis.abm-usuario.permisos.index')}}">
                    Listado de Permisos
                </x-nav.dropdown-link>
            </x-slot>
        </x-nav.dropdown-sub>

        <div class="border-t border-gray-100"></div>

        <x-nav.dropdown-link href="{{route('sis.noticias.index')}}">
            Noticias
        </x-nav.dropdown-link>
    </x-slot>

</x-nav.dropdown>
