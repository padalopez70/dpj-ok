<div class="">

     <div class="container bg-dark text-white p-2" titulo="Documentos vinculados al expediente: {{$nombre_entidad}}">
{{--         <h5> Documentos vinculados a la entidad: <b> {{$fila['numero']}}-{{$fila['codigo']}}-{{$fila['anio']}}</b></h5> --}}
        <h5>Entidad: <b>{{$nombre_entidad}}</b></h5>
    </div>


    <x-slot name="header">

        <div class="col-span-6 relative">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Administración de Autoridades</h2>
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
{{--                 <div class="row">
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
 --}}
    <div class="row">
                    <div class="col-6">
                        <x-jet-label for="tipo" class="mt-2" value="Cargo *" />
                        <x-simple-select wire:model.defer="entidad_cargo.cargo_id"
                            name="cargo"
                            id="cargo"
                            :options='$cargos'
                            placeholder="Seleccionar un cargo" :searchable='false'
                            value-field='id' text-field='nombre'
                            class="form-select" />
                        <x-jet-input-error for="entidad_cargo.cargo_id" />
                    </div>

                    <div class="col-6">
                        <x-jet-label for="archivo" class="mt-2" value="Apellido y Nombre *" />
                        <x-jet-input wire:model.defer='entidad_cargo.nombre' placeholder="Ingrese Apellido y Nombre" type="text" class="text-dark w-full block" name="nombre" id="nombre"/>
                        <x-jet-input-error for="entidad_cargo.nombre" />
                    </div>
    </div>
    <div class="row">
            <div class="col-6">
                        <x-jet-label for="dni" class="mt-2" value="DNI *" />
                        <x-jet-input wire:model.defer='entidad_cargo.dni' placeholder="Ingrese el DNI" type="text" class="text-dark w-full block" name="dni" id="dni"/>
                        <x-jet-input-error for="entidad_cargo.dni" />
                    </div>


                    <div class="col-6">
                        <br>
                        <x-jet-label for="fecha_asuncion" value="Fecha Asunción  *" />
                        <x-flatpickr  :options='["maxDate" => "today"]'  wire:model="entidad_cargo.fecha_asuncion" id="fecha_asuncion" name="fecha_asuncion" />
                        <x-jet-input-error for="entidad_cargo.fecha_asuncion" />
                    </div>
    </div>
    <div class="row">
                    <div class="col-6">
                        <x-jet-label for="celular" class="mt-2" value="Celular" />
                        <x-jet-input wire:model.defer='entidad_cargo.celular' placeholder="Ingrese número de celular" type="text" class="text-dark w-full block" name="celular" id="celular"/>
                        <x-jet-input-error for="entidad_cargo.celular" />
                    </div>

                    <div class="col-6">
                        <x-jet-label for="email" class="mt-2" value="Email" />
                        <x-jet-input wire:model.defer='entidad_cargo.email' placeholder="Ingrese número de email" type="text" class="text-dark w-full block" name="email" id="email"/>
                        <x-jet-input-error for="entidad_cargo.email" />
                    </div>
    </div>

                    <div class="col">
                        <x-slot name="actions">
                            <div class="space-x-2">
                                @if(strstr( $path, '.create' ))
                                <x-jet-secondary-button wire:click="limpiarForm">Limpiar</x-jet-secondary-button>
                                @endif
                                <x-jet-button>Grabar</x-jet-button>
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
