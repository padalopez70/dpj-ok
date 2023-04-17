<div>

    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Usuario: {{$usuario->name}}</h2>
        </x-slot>
    </div>

    <div class="max-w-12xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-10">

{{--         <div class="max-w-4xl mx-auto bg-gray-300 rounded-md shadow-lg">
            <div class="p-2 pl-2">
                <h1 class="font-bold text-lg">Área del Usuario</h1>
            </div>
            <div class="bg-gray-50 pl-5 rounded-b-md">
                <div class="flex pr-5 py-4">
                    <div class="flex-1">
                        <x-simple-select wire:model="area_id" name="area_id" id="area_id" :options='$areas'
                            placeholder="Seleccionar Área" search-input-placeholder="Seleccionar Área"
                            :searchable='true' value-field='id' text-field='nombre' class="form-select" />
                        <x-jet-input-error for="area_id" />
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="max-w-4xl mx-auto bg-gray-300 rounded-md shadow-lg">
            <div class="p-2 pl-2">
                <h1 class="font-bold text-lg">Estado</h1>
            </div>
            <div class="bg-gray-50 pl-5 pb-5 rounded-b-md">
                <div class="flex pr-5 py-4">
                    <x-select wire:model="estado" :opciones='$estado_opciones' class="flex-1" />
                </div>
                <div class="flex-1 ">
                    <x-jet-label for="estado_motivo" value="Motivo del Estado" />
                    <div class="flex space-x-1 pr-5">
                        <x-jet-input wire:model.defer='estado_motivo' type="text" name="estado_motivo"
                            id="estado_motivo" class="w-full" />
                        <x-jet-secondary-button wire:click="guardarEstadoMotivo" class="!p-2.5">
                            <x-ico2 name="arrow-down-tray" />
                        </x-jet-secondary-button>
                    </div>
                </div>
            </div>
        </div>


        <div class="max-w-4xl mx-auto bg-gray-300 rounded-md shadow-lg">
            <div class="p-2 pl-2">
                <h1 class="font-bold text-lg">Permisos</h1>
            </div>
            <div class="bg-gray-50 pl-5 rounded-b-md">
                @foreach ($permiso_tipos as $permiso_tipo)
                <div class="flex py-2">
                        <x-toggle-button accion="permisoGuardar({{$permiso_tipo->id}})" nombre="{{$permiso_tipo->nombre}}:"
                            descripcion="{{$permiso_tipo->descripcion}}" checked="{{$permiso_tipo->checked}}" />
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
