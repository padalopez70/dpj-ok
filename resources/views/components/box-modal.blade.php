@props([
    'maxH' => 'h-96',
    'tituloFondo' => 'bg-gray-300',
    'botoneraFondo' => 'bg-gray-200'
])

<div>
    <div class="px-3 py-2 {{$tituloFondo}} text-lg text-left rounded-t-md font-bold shadow-md">
        {{$titulo}}
    </div>

    <div class="p-2 mx-auto {{$maxH}} overflow-y-auto">
        {{$slot}}
    </div>

    <div>
        <div class="flex justify-end px-3 py-2 {{$botoneraFondo}} text-right shadow rounded-b-md">
            <div class="space-x-2">
                {{$botonera}}
            </div>
        </div>
    </div>
</div>
