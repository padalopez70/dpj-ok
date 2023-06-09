<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear o Editar Entidad</h2>
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

                    <div class="col-span-6">
                        <x-jet-label for="titulo" value="Entidad Nombre *" />
                        <x-jet-input wire:model.defer='entidad.denominacion' type="text" name="entidad" id="entidad"
                            class="w-full block" />
                        <x-jet-input-error for="entidad.denominacion" />
                    </div>

                    <div class="col-span-4">
                        <x-jet-label for="tipo" value="Tipo de Entidad *" />
                         <x-simple-select wire:model.defer="entidad.id_tipo_entidad"
                             name="id_tipo_entidad"
                             id="id_tipo_entidad"
                             :options='$tipos'
                             placeholder="Seleccionar Tipo" :searchable='true' value-field='id' text-field='denominacion_tipo'
                             class="form-select" />
                         <x-jet-input-error for="entidad.id_tipo_entidad" />
                     </div>

                     <div class="col-span-6">
                         <x-jet-label for="titulo" value="Legajo *" />
                         <x-jet-input wire:model.defer='entidad.legajo' type="text" name="legajo" id="legajo"
                             class="w-full block" />
                         <x-jet-input-error for="entidad.legajo" />
                     </div>

                     <div class="col-span-4">
                        <x-jet-label for="titulo" value="Domicilio *" />
                        <x-jet-input wire:model.defer='entidad.domicilio' type="text" name="domicilio" id="domicilio"
                            class="w-full block" />
                        <x-jet-input-error for="entidad.domicilio" />
                    </div>

                    <div class="col-span-6">
                        <x-jet-label for="titulo" value="Teléfono *" />
                        <x-jet-input wire:model.defer='entidad.telefono' type="text" name="telefono" id="telefono"
                            class="w-full block" />
                        <x-jet-input-error for="entidad.telefono" />
                    </div>


                    {{------------------ SELECT DEPARTAMENTO ---------------}}
                    <div class="col-span-4">
                        <x-jet-label for="tipo" value="Departamento" />
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
                    <div class="col-span-6">
                        <x-jet-label for="tipo" value="Localidad" />
                         <x-simple-select wire:model.defer="localidad_seleccionada"
                             name="localidad_seleccionada"
                             id="localidad_seleccionada"
                             :options='$localidades'
                             placeholder="Seleccionar Localidad" :searchable='true' value-field='localidad_id' text-field='localidad'
                             class="form-select" />
                         <x-jet-input-error for="entidad.id_localidad" />
                     </div>
                     {{-- @endif --}}



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
