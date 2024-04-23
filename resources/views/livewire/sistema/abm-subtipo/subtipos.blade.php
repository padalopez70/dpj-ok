<x-box-titulo titulo="SubTipos de Entidad">

    <x-slot name="botonera">
        <x-button>

            <a href="{{ route('sis.subtipos.create') }}">Crear</a>

        </x-button>
    </x-slot>

    <slot>
        <livewire:sistema.abm-sub-tipo.sub-tipos-tabla/>

    </slot>

</x-box-titulo>
