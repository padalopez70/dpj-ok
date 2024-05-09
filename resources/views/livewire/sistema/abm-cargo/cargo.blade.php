<x-box-titulo titulo="Cargos">

    <x-slot name="botonera">
        <x-button>

            <a href="{{ route('sis.cargo.create') }}">Crear</a>

        </x-button>
    </x-slot>

    <slot>
        <livewire:sistema.abm-cargo.cargo-tabla/>

    </slot>

</x-box-titulo>
