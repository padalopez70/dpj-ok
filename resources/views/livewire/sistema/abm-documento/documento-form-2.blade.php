{{-- <x-box-titulo titulo="Documentos vinculados al expediente: {{$fila->expediente}}">
</x-box-titulo> --}}
<div class="container bg-dark text-white p-2" titulo="Documentos vinculados al expediente: {{$fila->expediente}}">
    Documentos vinculados al expediente:<h3> {{$fila->expediente}}</h3>
</div>
<div>


    <div>
        <div class="container bg-success pb-10">

{{--
              Nro. Expediente: {{$fila->expediente}}<br>
              Entidad: {{$fila->id_entidad}}
 --}}

 <form submit="guardar"  autocomplete="off" method="POST" enctype="multipart/form-data">


                      {{--
                    <div class="col-span-6">

                            <x-jet-label for="tipo" value="Tipo *" />
                        <x-simple-select wire:model.defer="noticia.tipo" name="tipo" id="tipo" :options='$tipos'
                            placeholder="Seleccionar Tipo" :searchable='true' value-field='id' text-field='nombre'
                            class="form-select" />
                        <x-jet-input-error for="noticia.tipo" />
                    </div>
                    --}}

                    <input wire:model.defer='id_novedad' value="" type="hidden" name="id_novedad" id="id_novedad"
                    class="w-full block" />
                <input-error for="documento.id_novedad" />


                    <div class="col-span-6 bg-danger">
                        <div class="form-row bg-light text-white p-3 ">
                                <div class="col">
                                    <label for="titulo" value="" />
                                    <x-jet-input wire:model.defer='path' class="mt-5" type="file" name="documento" id="documento"
                                        class="w-full block" />
                                    <input-error for="documento.path" />
                                </div>

                                <div class="col">

                                    <input wire:model.defer='documento.comentario' placeholder="Ingrese un comentario" type="text" class="text-dark" name="comentario" id="comentario"
                                        />
                                    <input-error for="documento.comentario" />
                                </div>
                                <div class="col">

                                <button class="btn-primary p-2">Vincular</button>
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




            </form>
         {{-- </x-form-section> --}}
        </div>
    </div>
</div>
