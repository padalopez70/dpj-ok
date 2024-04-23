<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear o Editar un Expediente</h2>
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

                    <div class=" col-span-6 form-row bg-light p-2">
                        <div class="col">
                            <x-jet-label for="tipo" value="Nro. Expediente: {{$novedad->numero}}-{{$novedad->codigo}}-{{$novedad->anio}}" />
                        </div>
                        <div class="col">
                            <x-jet-input wire:model.defer='novedad.numero' placeholder="número" type="hidden" style="width: 10ch;" name="numero" id="numero"/>
                            <x-jet-input-error for="novedad.numero" />
                        </div>
                        <div class="col">
                            <x-jet-input wire:model.defer='novedad.codigo' placeholder="código" type="hidden" style="width: 10ch;" name="codigo" id="codigo"/>
                            <x-jet-input-error for="novedad.codigo" />
                        </div>
                        <div class="col">
                            <x-jet-input wire:model.defer='novedad.anio' value="33333333" placeholder="año" type="hidden" style="width: 10ch;" name="anio" id="anio"/>
                            <x-jet-input-error for="novedad.anio" />
                        </div>

                    </div>


                    <!-- searchbox-personal -->
                    <div class='col-span-12'>
                        <x-jet-label for='id_entidad' value='Entidad *' class='capitalize' />
                        <div class="col-span-12">
                            <livewire:search-box-entidades id="id_entidad" listener="entidadTraer"
                                placeholder="Denominación o Legajo" :mostrar="$novedad->id_entidad"/>
                            <x-jet-input-error for="novedad.id_entidad" />
                        </div>
                    </div>
                    <!-- searchbox-personal -->
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
                        <x-jet-label for="tipo" value="Entidad *" style="float:relative;"/>
                        <div class="dropdown text-left " style="float:relative;top:-5px;">
                            <i class=" fa-solid fa-lg  fa-circle-info" data-toggle="dropdown"></i>
                            <ul class="dropdown-menu bg-info text-white container ">
                                <div class="" style="margin:20px; ">
                                <b>Cómo elegir una Entidad?</b><br><br>
                                <b>1- </b> Para elegir la Entidad despligue el listado de Entidades haciendo click en flecha de la derecha<br>
                                <b>2- </b>Luego podrá seleccionar la Entidad haciendo un click sobre ella<br>
                                <b>3- </b> Si el listado de Entidades es extenso podrá tipear parte del nombre para ir filtrando el listado<br>

                                </div>
                            </ul>
                        </div>

                        @if($puedo_cambiar_entidad=="si")
                                <x-simple-select wire:model.defer="novedad.id_entidad"
                                    name="id_entidad1"
                                    id="id_entidad1"
                                    :options="$entidades"
                                    placeholder="Seleccionar Entidad"
                                    :searchable='true'
                                    value-field='id'
                                    text-field='denominacion'
                                    class="form-select"
                                    />
                        @else
                                <x-simple-select wire:model.defer="novedad.id_entidad"
                                name="id_entidad2"
                                id="id_entidad2"
                                :options="$entidades"
                                placeholder="Seleccionar Entidad"
                                :searchable='true'
                                value-field='id'
                                text-field='denominacion'
                                class="form-select"
                                disabled
                                />
                        @endif
                             <x-jet-input-error for="novedad.id_entidad" />

                     </div>



                    <div class="col-span-6">
                        <x-jet-label for="tipo" value="Tipo de Novedad" />
                         <x-simple-select wire:model.defer="novedad.id_tipo_novedad"
                             name="id_tipo_novedad"
                             id="id_tipo_novedad"
                             :options="$tipos_novedades"
                             placeholder="Seleccionar tipo de novedad" :searchable='true' value-field='id' text-field='novedad_denominacion'
                             class="form-select"

                             />
                         <x-jet-input-error for="novedad.id_tipo_novedad" />
                     </div>

                     <div class="col-span-6">
                        <x-jet-label for="fecha_inicio" value="Fecha  *" />
                        <x-flatpickr  :options='["maxDate" => "today"]'  wire:model="novedad.fecha" id="fecha" name="fecha" />
                        <x-jet-input-error for="novedad.fecha" />
                    </div>

                    <div class="col-span-6">
                        <x-jet-label for="titulo" value="Descripcion *" />
                        <x-jet-input wire:model.defer='novedad.novedad_descripcion' type="text" name="novedad" id="novedad"
                            class="w-full block" />
                        <x-jet-input-error for="novedad.novedad_descripcion" />
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
