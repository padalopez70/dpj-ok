<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{$label_formulario}}</h2>
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


{{--                      <div class="col-md-6 col-sm-12">

                        <x-jet-label for="genera_gde" value="Genera GDE" />
                         <x-simple-select wire:model.defer="novedad.genera_gde"
                             name="genera_gde"
                             id="genera_gde"
                             :options="$opciones_gde"
                             placeholder="" :searchable='false' value-field='id' text-field='texto'
                             class="form-select"

                             />
                         <x-jet-input-error for="novedad.genera_gde" />
                     </div>
 --}}

                     </div>
                     <br>

                     <div class="col-span-6">
                        <x-jet-label for="titulo" value="GDE *" />

                        <div class="flex space-x-1">
                            <div class="w-full">
                                <x-jet-input wire:model.defer='novedad.gde' type="text" name="gde" id="gde" class="w-full block" />
                            </div>
                            <div class="w-64 pt-2 text-right"><x-button wire:click="controlarGde()" wire:loading.attr="disabled">Verificar GDE</x-button></div>
                        </div>
                        <x-jet-input-error for="novedad.gde" />
                    </div>

                    <br>

                    <div class="col-span-6">
                        <x-jet-label for="titulo" value="Descripcion *" />
                        <x-jet-input wire:model.defer='novedad.novedad_descripcion' type="text" name="novedad" id="novedad"
                            class="w-full block" disabled />
                        <x-jet-input-error for="novedad.novedad_descripcion" />
                    </div>





                    <div class="col-span-6">
                        <x-slot name="actions">
                            <div class="space-x-2">
                                @if(strstr( $path, '.create' ))
                                <x-jet-secondary-button wire:click="limpiarForm">Limpiar</x-jet-secondary-button>
                                @endif

                                @if($expedienteOk)
                                <x-jet-button>Guardar</x-jet-button>
                                @endif
                            </div>
                        </x-slot>
                    </div>

                </x-slot>
            </x-form-section>
        </div>
    </div>
</div>
