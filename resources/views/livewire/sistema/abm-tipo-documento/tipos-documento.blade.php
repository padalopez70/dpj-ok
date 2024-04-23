<x-box-titulo titulo="Tipos de Documento">

    <x-slot name="botonera">
        <x-button>

            <a href="{{ route('sis.tiposdocumento.create') }}">Crear</a>

        </x-button>
    </x-slot>

    <slot>
        <livewire:sistema.abm-tipo-documento.tipos-documento-tabla/>

    </slot>

</x-box-titulo>
