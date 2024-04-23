<div class="relative">
    <input
        type="text"
        {{($datoSeleccionado) ? 'disabled' : ''}}
        wire:loading.class="focus:!ring-cyan-500 focus:!ring-opacity-50"
        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        placeholder="{{$placeholder}}"
        wire:model.1000ms="query"

        {{-- wire:keydown.tab="reseteo" --}}
    />
    <div class="absolute right-0 flex pr-2 z-12 top-2 justify-items-end">
        @if ($datoSeleccionado)
            <div wire:click="reseteoSeleccion()"><x-ico2 name="x-circle" class="text-red-400 bg-white cursor-pointer" /></div>
        @else
            <x-ico2 name="x-circle" class="text-gray-300" />
        @endif
    </div>

    @if(!empty($query))
        @if($datoSeleccionado == false)
        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="reseteo"></div>
        <div class="absolute z-10 w-full py-1 overflow-y-scroll bg-white border-2 border-gray-300 shadow-lg rounded-b-md max-h-32">

        <!-- fix de error NO TOCAR NO ANDA CON IF-->
            <div class="{{empty($datos) == true ? 'show' : 'hidden'}} p-2 text-gray-400 italic">
                @if ($this->minError == true)
                    {!!$minErrorLeyenda!!}
                @elseif(empty($datos))
                    {{$sinResultado}}
                @endif
            </div>

            @if(!empty($datos))
            @foreach($datos as $i => $dato)
            <div wire:click="datoSeleccionar({{$i}})" class="p-2 cursor-pointer hover:bg-blue-600 hover:text-white">
                {!! isset($dato['textoH']) ? $dato['textoH'] : $dato['texto']!!}
            </div>
            @endforeach
            @endif
        </div>
        @endif
    @endif
</div>
