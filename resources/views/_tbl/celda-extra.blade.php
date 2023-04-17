<div class="flex justify-center space-x-4 font-bold">

    <div class="text-base">
        {{$value}}
    </div>
    <div>
        <a href="#" wire:click="$emit('modalProductoExtraMostrar',{{$row->id}})"><x-ico2 name="chat-bubble-bottom-center-text" /></a>
    </div>

</div>
