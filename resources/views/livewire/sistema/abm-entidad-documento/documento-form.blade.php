<div class="">

     <div class="container bg-dark text-white p-2" titulo="Documentos vinculados al expediente: {{$nombre_entidad}}">
{{--         <h5> Documentos vinculados a la entidad: <b> {{$fila['numero']}}-{{$fila['codigo']}}-{{$fila['anio']}}</b></h5> --}}
        <h5>Entidad: <b>{{$nombre_entidad}}</b></h5>
    </div>


    <x-slot name="header">

        <div class="col-span-6 relative">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Vincular documento a la Entidad</h2>

            <a href="{{route($view)}}">
                <x-ico2s name="backward" style="top: -5px;" class="h-10 w-10 mt-0 absolute right-0 fill-sky-300" />
            </a>


    </x-slot>

    <div>
        <div class="container">
            <x-form-section submit="guardar" autocomplete="off">
                <x-slot name="title" class="bg-success"><b></b></x-slot>
                <x-slot name="description" class="bg-info">
                    <div>

                    </div>
                </x-slot>

                <x-slot name="form" class="bg-dark">
                <div class="row">
                    <div class="col-12">
                        <x-jet-label for="archivo" value="Documento * (PDF,JPG, PNG. max. 2MB)" />
                        <div class="flex space-x-1">
                            <div class="w-full">
                                <x-upload-form archivo="archivo" >
                                    <slot class="bg-primary">
                                        <x-ico2 name="arrow-up-tray" />
                                        <div class="pl-1  whitespace-nowrap">Seleccionar archivo</div>
                                    </slot>
                                </x-upload-form>
                            </div>
                        </div>
                        <x-jet-input-error for="archivo" />
                    </div>

                    <div class="col-12">
                        <x-jet-label for="tipo" class="mt-2" value="Tipo documento *" />
                        <x-simple-select wire:model.defer="documento.tipo_documento"
                            name="tipo_documento"
                            id="tipo_documento"
                            :options='$vector_tipo_documento'
                            placeholder="Seleccionar Tipo de documento" :searchable='false'
                            value-field='id' text-field='texto'
                            class="form-select" />
                        <x-jet-input-error for="documento.tipo_documento" />
                    </div>

                    <div class="col-12">
                        <x-jet-label for="archivo" class="mt-2" value="Comentario" />
                        <x-jet-input wire:model.defer='documento.comentario' placeholder="Ingrese un comentario" type="text" class="text-dark w-full block" name="comentario" id="comentario"/>
                        <x-jet-input-error for="documento.comentario" />
                    </div>

                    <div class="col">
                        <x-slot name="actions">
                            <div class="space-x-2">
                                @if(strstr( $path, '.create' ))
                                <x-jet-secondary-button wire:click="limpiarForm">Limpiar</x-jet-secondary-button>
                                @endif
                                <x-jet-button>Vincular</x-jet-button>
                            </div>
                        </x-slot>
                    </div>
                </div>
                </x-slot>
            </x-form-section>
        </div>
    </div>
</div>



{{-- <div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear o Editar Estado</h2>
    </x-slot>

    <div>
        <div class="container">
            <x-form-section submit="guardar" autocomplete="off" enctype="multipart/form-data">
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


                    <div class="col-span-6">
                        <x-jet-label for="titulo" value="" />
                        <x-jet-input wire:model.defer='archivo' class="mt-5" type="file" name="archivo" id="archivo"
                            class="w-full block" />
                        <x-jet-input-error for="archivo" />
                    </div>
                    <div class="col">
                        <x-jet-input wire:model.defer='documento.comentario' placeholder="Ingrese un comentario" type="text" class="text-dark" name="comentario" id="comentario"/>
                        <x-jet-input-error for="documento.comentario" />
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
</div> --}}
