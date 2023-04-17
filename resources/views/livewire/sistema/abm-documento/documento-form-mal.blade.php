
<div class="">

        <div class="container bg-dark text-white p-2" titulo="Documentos vinculados al expediente: {{$fila->expediente}}">
            Documentos vinculados al expediente:<h3> {{$fila->numero}}-{{$fila->codigo}}-{{$fila->anio}}</h3>

        </div>


    <div class="">

        <div class="container">
             Entidad:<h4>{{$nombre_entidad}}</h4>


                <x-form-section submit="guardar" autocomplete="off" >
                <x-slot name="title"><b></b></x-slot>
                <x-slot name="description">
                    <div class="">


                    </div>
                </x-slot>
                <x-slot name="form">

                     <div class="float-right justify-content-end text-right">
                    </div>


                    <div class="col-span-12">

                        <div class="form-row bg-success mb-4 text-white p-1 ">
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
                            <div class="col">
                                <x-jet-button class="btn-primary">Vincular</x-jet-button>
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

{{--                             <div class="col  ">
                                <a href="{{route($view)}}" class="text-right">
                                    <x-ico2s name="backward"  />
                                </a>
                            </div>
 --}}

                        </div>
                    </div>



                </x-slot>
            </x-form-section>
        </div>
    </div>
</div>
