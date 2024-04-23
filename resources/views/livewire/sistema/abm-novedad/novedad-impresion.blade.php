
<style>
@media print {
     body {
        background: white; /* Cambia el fondo a blanco para evitar que se imprima el fondo predeterminado */
    }

    #zona_de_impresion {
        /* Estilos específicos para el div "zona_de_impresion" */
        border: 1px solid black; /* Ejemplo: Agrega un borde al div */
        padding: 20px; /* Ejemplo: Agrega un espacio de relleno alrededor del contenido */
    }
}

.titulo-prueba{
    font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace !important;
}

</style>



<div >

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{$label_formulario}}</h2>
    </x-slot>

    <div>
        <div class="container" id="zona_de_impresion">

            <x-form-section submit="guardar" autocomplete="off">
                <x-slot name="title"><b></b></x-slot>
                <x-slot name="description">
                    <div >

                    </div>
                </x-slot>

                <x-slot name="form">

{{--                     <div class="col-span-6 relative">
                        <a href="{{route($view)}}">
                            <x-ico2s name="backward" class="h-10 w-10 absolute right-0 fill-sky-300" />
                        </a>
                    </div> --}}

                    <div class=" col-span-6 form-row bg-light p-2" id="zona_de_impresion">
                        <div class="col">
                        {{--
                        <x-jet-label for="tipo" value="Nro. Expediente: {{$novedad->numero}}-{{$novedad->codigo}}-{{$novedad->anio}}" />
                        --}}
                                  Nro. Expediente: <h3>{{$novedad->numero}}-{{$novedad->codigo}}-{{$novedad->anio}}</h3>

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
                                placeholder="Nombre de la Entidad o número de Legajo" :mostrar="$novedad->id_entidad"/>
                            <x-jet-input-error for="novedad.id_entidad" />
                        </div>
                    </div>
                    <!-- searchbox-personal -->


                    <div class="col-span-6">

                        <div class="dropdown text-left " style="float:relative;top:-5px;">
                            <i class=" fa-solid fa-lg  fa-circle-info" data-toggle="dropdown"></i>
                            <ul class="dropdown-menu bg-info text-white container ">
                                <div class="" style="margin:20px; ">
                                <b>Cómo elegir una Entidad?</b><br><br>
                                <b>1- </b> Tipear el nombre de la Entidad o su número de Legajo<br>
                                 <b>2- </b>Luego podrá seleccionar Entidad haciendo un click sobre el nombre de  ella<br>

                                {{-- <b>3- </b> Si el listado de Entidades es extenso podrá tipear parte del nombre para ir filtrando el listado<br>
 --}}
                                </div>
                            </ul>
                        </div>



                    <div class="row">
                            <div class="col-md-6 col-sm-12">

                        <x-jet-label for="tipo" value="Tipo de Novedad" />
                         <x-simple-select wire:model.defer="novedad_tipos"
                             name="id_tipo_novedad"
                             id="id_tipo_novedad"
                             :options="$tipos_novedades"
                             placeholder="Seleccionar tipo de novedad"
                             :searchable='true'
                             value-field='id'
                             text-field='novedad_denominacion'
                             class="form-select"
                            multiple
                             />
                         <x-jet-input-error for="novedad.id_tipo_novedad" />
                     </div>

{{--
                     <div class="col-span-6">
                        <x-jet-label for="fecha_inicio" value="Fecha  *" />
                        <x-flatpickr  :options='["maxDate" => "today"]'  wire:model="novedad.fecha" id="fecha" name="fecha" />
                        <x-jet-input-error for="novedad.fecha" />
                    </div> --}}


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
                        <x-jet-label for="titulo" value="Descripcion *" />
                        <x-jet-input wire:model.defer='novedad.novedad_descripcion' type="text" name="novedad" id="novedad"
                            class="w-full block" />
                        <x-jet-input-error for="novedad.novedad_descripcion" />
                    </div>



{{--                     <div class="col-span-6">
                        <x-slot name="actions">
                            <div class="space-x-2">
                                @if(strstr( $path, '.create' ))
                                <x-jet-secondary-button wire:click="limpiarForm">Limpiar</x-jet-secondary-button>
                                @endif
                                <x-jet-button>Guardar</x-jet-button>
                                <a href="javascript: imprimirPagina()">Imprimir</a>
                            </div>
                        </x-slot>
                    </div> --}}

                </x-slot>
            </x-form-section>
        </div>
    </div>
</div>

<script>

    // Función para imprimir automáticamente al cargar la página
    function imprimirPagina() {
        setTimeout(function() {
    //console.log("Esta sentencia se ejecuta después de 2 segundos");
    window.print(); // Inicia la función de impresión del navegador
    }, 1000);
       // window.print(); // Inicia la función de impresión del navegador
    }

    // Llama a la función para imprimir automáticamente cuando se carga la página
    window.addEventListener('load', imprimirPagina);
</script>
