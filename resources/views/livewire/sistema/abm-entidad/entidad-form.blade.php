<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear o Editar Entidad</h2>
    </x-slot>

    <div class="container bg-ligth shadow">
        <div class="">
            <x-form-section-ancho submit="guardar" autocomplete="off">
                <x-slot name="title"><b></b></x-slot>
                <x-slot name="description">
                    <div>


                    </div>
                </x-slot>
                <x-slot name="form">

{{--                     <div class="col-span-6 relative">
                        <a href="{{route($view)}}">
                            <x-ico2s name="backward" class="h-10 w-10 absolute right-0 fill-sky-300" />
                        </a>
                    </div> --}}
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 ">
                            <x-jet-label for="titulo" value="Entidad Nombre *" />
                            <x-jet-input wire:model.defer='entidad.denominacion' type="text" name="entidad" id="entidad"
                                class="w-full block" />
                            <x-jet-input-error for="entidad.denominacion" />
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <x-jet-label for="tipo" value="Tipo de Entidad *" />
                            <x-simple-select

                                wire:model="entidad.id_tipo_entidad"
                                :options='$tipos'
                                searh-input-placeholder="Seleccionar Tipo"
                                placeholder="Seleccionar Tipo"
                                :searchable='true'
                                value-field='id'
                                text-field='nombre'
                                class="form-select"
                                 />
                            <x-jet-input-error for="entidad.id_tipo_entidad" />
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <x-jet-label for="entidades_subtipo" class="mt-3 mb-1" value="Entidades Subtipo *" />
                            <x-simple-select

                                wire:model.defer="entidad_subtipos"
                                name="entidad_subtipos"
                                :options='$subtipos'
                                searh-input-placeholder="Seleccionar Subtipos"
                                placeholder="Seleccionar Subtipo"
                                :searchable='true'
                                value-field='id'
                                text-field='nombre'
                                class="form-select"
                                multiple
                                 />
                            <x-jet-input-error for="entidad_subtipos" />
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <x-jet-label for="titulo" class="mt-3 mb-1" value="Email *" />
                            <x-jet-input wire:model.defer='entidad.email' type="text" name="email" id="email"
                                class="w-full block" />
                            <x-jet-input-error for="entidad.email" />
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <x-jet-label for="titulo" class="mt-3 mb-1" value="Legajo *" />
                            <x-jet-input wire:model.defer='entidad.legajo' type="text" name="legajo" id="legajo"
                                class="w-full block" />
                            <x-jet-input-error for="entidad.legajo" />
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <x-jet-label for="tipo" class="mt-3 mb-1" value="Estado *" />
                            <x-simple-select wire:model.defer="entidad.id_estado"
                                name="id_estado"
                                id="id_estado"
                                :options='$estados'
                                placeholder="Seleccionar Estado" :searchable='true' value-field='id' text-field='denominacion_estado'
                                class="form-select" />
                            <x-jet-input-error for="entidad.id_estado" />


                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <x-jet-label for="titulo" class="mt-3 mb-1" value="Teléfono *" />
                            <x-jet-input wire:model.defer='entidad.telefono' type="text" name="telefono" id="telefono"
                                class="w-full block" />
                            <x-jet-input-error for="entidad.telefono" />
                        </div>
                        <div class="col-6">
                            <x-jet-label for="titulo" class="mt-3 mb-1" value="Domicilio *" />
                            <x-jet-input wire:model.defer='entidad.domicilio' type="text" name="domicilio" id="domicilio"
                                class="w-full block" />
                            <x-jet-input-error for="entidad.domicilio" />

                        </div>
                    </div>
                    <div class="row">
                        {{------------------ SELECT DEPARTAMENTO ---------------}}
                        <div class="col-md-6 col-sm-12">
                            <x-jet-label for="tipo" class="mt-3 mb-1" value="Departamento" />
                            <x-simple-select wire:model="DepartamentoSeleccionado"
                                name="departamento_seleccionado"
                                id="departamento_seleccionado"
                                :options='$departamentos'
                                placeholder="Seleccionar Departamento" :searchable='true' value-field='departamento_id' text-field='departamento'
                                class="form-select" />
                            <x-jet-input-error for="entidad.id_departamento" />
                        </div>
                            {{------------------ SELECT LOCALIDAD ---------------}}
                            {{-- @if (!is_null($localidades)) --}}
                        <div class="col-md-6 col-sm-12">
                                <x-jet-label for="tipo" class="mt-3 mb-1" value="Localidad" />
                                <x-simple-select wire:model.defer="localidad_seleccionada"
                                    name="localidad_seleccionada"
                                    id="localidad_seleccionada"
                                    :options='$localidades'
                                    placeholder="Seleccionar Localidad" :searchable='true' value-field='localidad_id' text-field='localidad'
                                    class="form-select" />
                                <x-jet-input-error for="entidad.id_localidad" />
                         </div>
                            {{-- @endif --}}
                    </div>
                    <div class="row">
                        <div class="col-12 mt-5">
                            <x-slot name="actions">
                                <div class="space-x-2 ">
                                    @if(strstr( $path, '.create' ))
                                    <x-jet-secondary-button wire:click="limpiarForm">Limpiar</x-jet-secondary-button>
                                    @endif
                                    <x-jet-button>Guardar</x-jet-button>
                                </div>
                            </x-slot>
                        </div>
                    </div>

                </div>











                </x-slot>
            </x-form-section>
        </div>
    </div>
</div>
