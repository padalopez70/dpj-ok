@props(['titulo'])
<div class=" w-full pt-2 py-1 px-1 md:px-2">

    <div class="flex space-x-1">
        @if (isset($titulo))

            <div class="bg-dark text-white {{!isset($botonera) ? 'w-full' : ''}} h-12 px-10 mb-1 pt-3 bg-slate-300 font-bold uppercase rounded-md shadow-md md:whitespace-nowrap">
            {{-- <div class="h-12 px-10 pt-2 bg-slate-300 font-bold text-sm uppercase rounded-md shadow-md underline"> --}}
                {{$titulo}}
            </div>
        @endif

        @if (isset($botonera))
            <div class="w-full">
                <div class="h-12 px-1 bg-slate-200 shadow-md rounded-md flex space-x-2 py-2">
                    {{$botonera}}
                </div>
            </div>
        @endif
    </div>

    <div class="mt-1 p-1 shadow-md rounded-md bg-gray-200">
        {{$slot}}
    </div>

</div>
