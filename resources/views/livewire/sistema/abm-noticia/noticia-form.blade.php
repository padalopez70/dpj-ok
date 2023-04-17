<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear o Editar una Noticia</h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-form-section submit="guardar" autocomplete="off">
                <x-slot name="title"><b>Noticia</b></x-slot>
                <x-slot name="description">
                    <div>
                        <p class="pb-4">
                            - <u>Campo Noticia:</u><br>Si es cargado, la Noticia saldrá tambien en el Dashboard. Sino solo aparecerá como Banner.
                        </p>
                        <p>
                            - <u>Tipo (Color Banner):</u>
                        </p>
                        <div class="px-2 p-2 pb-4 flex space-x-1">
                            <div class="w-auto h-8 bg-sky-600 rounded-md shadow-md p-2 text-sm text-white font-bold">
                                INFO</div>
                            <div class="w-auto h-8 bg-green-600 rounded-md shadow-md p-2 text-sm text-white font-bold">
                                EXITO</div>
                            <div class="w-auto h-8 bg-red-600 rounded-md shadow-md p-2 text-sm text-white font-bold">
                                ALARMA</div>
                            <div class="w-auto h-8 bg-gray-600 rounded-md shadow-md p-2 text-sm text-white font-bold">
                                GENERAL</div>
                        </div>
                        <p class="pb-4">
                            - <u>Fecha:</u><br> Fecha que se mostrará (Fecha de la noticia).
                        </p>
                        <p>
                            - <u>Fecha Inicio y Fin:</u><br> Rango de tiempo durante el cual aparecerá el Banner.
                        </p>

                    </div>
                </x-slot>
                <x-slot name="form">

                    <div class="col-span-6 relative">
                        <a href="{{route($view)}}">
                            <x-ico2s name="backward" class="h-10 w-10 absolute right-0 fill-sky-300" />
                        </a>
                    </div>

                    <div class="col-span-6">
                        <x-jet-label for="tipo" value="Tipo *" />
                        <x-simple-select wire:model.defer="noticia.tipo" name="tipo" id="tipo" :options='$tipos'
                            placeholder="Seleccionar Tipo" :searchable='false' value-field='id' text-field='nombre'
                            class="form-select" />
                        <x-jet-input-error for="noticia.tipo" />
                    </div>

                    <div class="col-span-6">
                        <x-jet-label for="titulo" value="Titulo *" />
                        <x-jet-input wire:model.defer='noticia.titulo' type="text" name="titulo" id="titulo"
                            class="w-full block" />
                        <x-jet-input-error for="noticia.titulo" />
                    </div>

                    <div class="col-span-6">
                        <x-jet-label for="noticia" value="Noticia" />
                        <x-textarea wire:model.defer='noticia.noticia' name="noticia" id="noticia" rows="3"
                            class="w-full block" />
                        <x-jet-input-error for="noticia.noticia" />
                    </div>

                    <div class="col-span-6">
                        <x-jet-label for="fecha" value="Fecha *" />
                            <x-flatpickr wire:model="noticia.fecha" id="fecha" name="fecha"/>
                        <x-jet-input-error for="noticia.fecha" />
                    </div>

                    <div class="col-span-6">
                        <x-jet-label for="fecha_inicio" value="Fecha Inicio *" />
                        <x-flatpickr wire:model="noticia.fecha_inicio" id="fecha_inicio" name="fecha_inicio" />
                        <x-jet-input-error for="noticia.fecha_inicio" />
                    </div>

                    <div class="col-span-6">
                        <x-jet-label for="fecha_fin" value="Fecha Fin *" />
                        <x-flatpickr wire:model="noticia.fecha_fin" id="fecha_fin" name="fecha_fin" />
                        <x-jet-input-error for="noticia.fecha_fin" />
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
