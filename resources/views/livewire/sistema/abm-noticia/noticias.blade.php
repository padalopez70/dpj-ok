<x-box-titulo titulo="Noticias">

    <x-slot name="botonera">
        <x-button>
            <a href="{{ route('sis.noticias.create') }}">Crear</a>
        </x-button>
    </x-slot>

    <slot>
        <livewire:sistema.abm-noticia.noticias-tabla/>
    </slot>

</x-box-titulo>
