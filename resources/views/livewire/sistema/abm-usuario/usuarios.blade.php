<x-box-titulo titulo="Usuarios">
    <x-slot name="botonera">
        <x-button>
            <a href="{{ route('sis.abm-usuario.usuario.create') }}">Crear</a>
        </x-button>
    </x-slot>
    <slot>
        <livewire:sistema.abm-usuario.usuarios-tabla/>
    </slot>
</x-box-titulo>

