<div class="flex justify-center space-x-2">
    <a href="{{route($rutaEdit,$id)}}">
        <x-ico2 name="pencil-square"/>
    </a>
    <x-ico2 name="trash" wire:click="confirmarEliminacion({{$id}})" class="cursor-pointer"/>
</div>
