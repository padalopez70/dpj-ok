<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear o Editar un Tipo de Novedad</h2>
    </x-slot>

    <div>
        <div class="container">
            <x-form-section submit="guardar" autocomplete="off">
                <x-slot name="title"><b></b></x-slot>
                <x-slot name="description">
                    <div>


                    </div>
                </x-slot>
                <x-slot name="form">

                    <div class="col-span-6 relative">
                        <a href="{{route($view)}}">
                            <x-ico2s name="backward" class="h-10 w-10 absolute right-0 fill-sky-300" />
                        </a>
                    </div>
                     {{--
                    <div class="col-span-6">

                            <x-jet-label for="tipo" value="Tipo *" />
                        <x-simple-select wire:model.defer="noticia.tipo" name="tipo" id="tipo" :options='$tipos'
                            placeholder="Seleccionar Tipo" :searchable='true' value-field='id' text-field='nombre'
                            class="form-select" />
                        <x-jet-input-error for="noticia.tipo" />
                    </div>
                    --}}


                    <div class="col-span-6">
                        <x-jet-label for="titulo" value="Nombre del Tipo de Novedad *" />
                        <x-jet-input wire:model.defer='tipoNovedad.novedad_denominacion' type="text" name="tipoNovedad" id="tipNovedad"
                            class="w-full block" />
                        <x-jet-input-error for="tipoNovedad.novedad_denominacion" />
                    </div>

                    <div class="col-span-6">
                        <x-slot name="actions">
                            <div class="space-x-2">
                                @if(strstr( $path, '.create' ))
                                <x-jet-secondary-button wire:click="limpiarForm">Limpiar</x-jet-secondary-button>
                                @endif
                                <x-jet-button>Guardar</x-jet-button>
                            </div>
                        </x-slot>
                    </div>

                </x-slot>
            </x-form-section>
        </div>
    </div>
</div>
