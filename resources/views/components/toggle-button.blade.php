@props([
'nombre' => '',
'descripcion' => '',
'checked' => '',
'accion' => ''
])
<div class="flex justify-center">
    <div class="form-check form-switch">
        <input
            wire:click.prevent="{{$accion}}"
            class="form-check-input appearance-none mr-2 mt-1 w-9 rounded-full float-left h-5 align-top bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm"
            type="checkbox" {{$checked}} role="switch" id="chkbox-{{$nombre}}">
        <label class="form-check-label mx-4  text-gray-800" for="chkbox-{{$nombre}}"><b>
                {{$nombre}}
            </b>
            {{$descripcion}}
        </label>
    </div>
</div>
