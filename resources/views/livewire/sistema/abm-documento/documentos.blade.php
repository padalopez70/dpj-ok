<div class="">

   {{--  <x-slot name="botonera"> --}}

        {{-- <x-button><a href="{{ route('sis.documentos.create', $id_novedad) }}">Crear</a></x-button>
 --}}


         <livewire:sistema.abm-documento.documento-form :id_novedad="$id_novedad"/>


   {{--  </x-slot> --}}

        <livewire:sistema.abm-documento.documentos-tabla exportable :id_novedad="$id_novedad"/>


</div>



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
