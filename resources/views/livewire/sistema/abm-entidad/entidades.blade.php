<x-box-titulo titulo="Entidades">

    {{-- @if (!Permisos::control(200)) --}}

    @if (Permisos::control('202|203|1'))
        <x-button><a href="{{ route('sis.entidades.create') }}">Crear</a></x-button>


    <slot>
        @endif

        <livewire:sistema.abm-entidad.entidades-tabla/>

    </slot>

</x-box-titulo>











{{-- <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Entidades') }}
    </h2>
    <x-button>  <a href="{{ route('sis.entidades.create') }}">Crear</a></x-button>
</x-slot>

    <x-slot name="botonera">

    </x-slot>

    <slot>
        <livewire:sistema.abm-entidad.entidades-tabla/>

    </slot>
 --}}


{{-- <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Entidades') }}
    </h2>

        <x-button class="float left text-right">
            <a href="{{ route('sis.entidades.create') }}">Crear</a>
        </x-button>

</x-slot>
 <livewire:sistema.abm-entidad.entidades-tabla/> --}}


    {{-- <x-slot name="botonera">

    </x-slot>

    <slot>
        <livewire:sistema.abm-entidad.entidades-tabla/>
    </slot>

</x-box-titulo>
 --}}
