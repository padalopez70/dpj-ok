<x-box-titulo titulo="Tipos de Novedad">

    <x-slot name="botonera">
        <x-button>

            <a href="{{ route('sis.tiposnovedad.create') }}">Crear</a>

        </x-button>
    </x-slot>

    <slot>
        <livewire:sistema.abm-tipo-novedad.tipos-novedad-tabla/>

    </slot>

</x-box-titulo>
