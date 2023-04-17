<x-box-titulo titulo="Estados">

    <x-slot name="botonera">
        <x-button>

            <a href="{{ route('sis.estados.create') }}">Crear</a>

        </x-button>
    </x-slot>

    <slot>
         <livewire:sistema.abm-estado.estados-tabla/>

    </slot>

</x-box-titulo>
