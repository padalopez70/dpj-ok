{{-- <x-box-titulo titulo="Documentos vinculados al expediente: {{$fila->expediente}}">
</x-box-titulo> --}}
<div class="container bg-dark text-white p-2" titulo="Documentos vinculados al expediente: {{$fila->expediente}}">
    Documentos vinculados al expediente:<h3> {{$fila->expediente}}</h3>
</div>
<div>


    <div>
        <div class="container bg-success pb-10">


              Nro. Expediente: {{$fila->expediente}}<br>
              Entidad: {{$fila->id_entidad}}


 {{-- <form submit="guardar"  autocomplete="off" method="POST" enctype="multipart/form-data"> --}}
          <form wire:submit.prevent="guardar"  autocomplete="off" >
{{--                 <x-slot name="title"><b>titulo form</b></x-slot>
                <x-slot name="description"></x-slot>
                <x-slot name="form" > --}}


                    <x-jet-input wire:model.defer='id_novedad' value="" type="hidden" name="id_novedad" id="id_novedad"
                    class="w-full block" />
                <x-jet-input-error for="documento.id_novedad" />


                    <div class="col-span-6 bg-danger">
                        <div class="form-row bg-light text-white p-3 ">
                                <div class="col">
                                    <x-jet-label for="titulo" value="" />
                                    <x-jet-input wire:model.defer='archivo' class="mt-5" type="file" name="archivo" id="archivo"
                                        class="w-full block" />
                                    <x-jet-input-error for="archivo" />
                                </div>

                                <div class="col">

                                    <x-jet-input wire:model.defer='documento.comentario' placeholder="Ingrese un comentario" type="text" class="text-dark" name="comentario" id="comentario"
                                        />
                                    <x-jet-input-error for="documento.comentario" />
                                </div>
                                <div class="col">

                                <x-jet-button class="btn-primary">Vincular</x-jet-button>
                                </div>
                        </div>
                    </div>

{{--                     <div class="col-span-6">
                       <x-jet-label for="tipo" value="Tipo de Entidad *" />
                        <x-simple-select wire:model.defer="entidad.id_tipo_entidad"
                            name="id_tipo_entidad"
                            id="id_tipo_entidad"
                            :options='$tipos'
                            placeholder="Seleccionar Tipo" :searchable='true' value-field='id' text-field='denominacion_tipo'
                            class="form-select" />
                        <x-jet-input-error for="entidad.id_tipo_entidad" />
                    </div>
 --}}



   {{--              </x-slot> --}}
            {{-- </form> --}}
            </form>
        </div>
    </div>
</div>
