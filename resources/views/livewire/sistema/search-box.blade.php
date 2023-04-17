<div class="relative">
    <input
        type="text"
        {{($datoSeleccionado) ? 'disabled' : ''}}
        wire:loading.class="focus:!ring-cyan-500 focus:!ring-opacity-50"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
        placeholder="{{$placeholder}}"
        wire:model.1000ms="query"

        {{-- wire:keydown.tab="reseteo" --}}
    />
    <div class="pr-2 absolute z-10 top-2 right-0 flex justify-items-end">
        @if ($datoSeleccionado)
            <div wire:click="reseteoSeleccion()"><x-ico2 name="x-circle" class="cursor-pointer text-red-400 bg-white" /></div>
        @else
            <x-ico2 name="x-circle" class="text-gray-300" />
        @endif
    </div>

    @if(!empty($query))
        @if($datoSeleccionado == false)
        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="reseteo"></div>
        <div class="absolute z-10 w-full bg-white py-1 border-2 border-gray-300 rounded-b-md shadow-lg max-h-32 overflow-y-scroll">

        <!-- fix de error NO TOCAR NO ANDA CON IF-->
            <div class="{{empty($datos) == true ? 'show' : 'hidden'}} p-2 text-gray-400 italic">
                @if ($this->minError == true)
                    Ingresar <strong>{{$this->min}}</strong> Caracteres Min.
                @elseif(empty($datos))
                    {{$sinResultado}}
                @endif
            </div>

            @if(!empty($datos))
            @foreach($datos as $i => $dato)
            <div wire:click="datoSeleccionar({{$i}})" class="cursor-pointer p-2 hover:bg-blue-600 hover:text-white">
                {!! isset($dato['textoH']) ? $dato['textoH'] : $dato['texto']!!}
            </div>
            @endforeach
            @endif
        </div>
        @endif
    @endif
</div>
