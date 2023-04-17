<x-box-titulo titulo="Tipos de Entidad">

    <x-slot name="botonera">
        <x-button>

            <a href="{{ route('sis.tipos.create') }}">Crear</a>

        </x-button>
    </x-slot>

    <slot>
        <livewire:sistema.abm-tipo.tipos-tabla/>

    </slot>

</x-box-titulo>
