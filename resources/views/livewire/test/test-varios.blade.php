<x-box-titulo titulo="Varios Ejemplos de Laravel/Blade/Livewire">
    <slot>
        <div class="flex w-12/12 p-10 gap-10">

        <!-- alertas -->
        <div class="bg-gray-300 rounded-md shadow-md h-40 p-2 w-4/12">
            Alerta via wire-modal:<br>
            <x-button type="button" onclick="Livewire.emit('openModal', 'sistema.alerta-modal', {{ json_encode(['data' => ['alertaTipo' => 'construccion']]) }})">
                Ejecutar
            </x-button>
            <br>
            <br>
            Alerta via sa2:
            <div class="flex space-x-1">
                <x-button type="button" wire:click="sa2Default()">Default</x-button>
                <x-button type="button" wire:click="sa2Confirmar()">Confirmar</x-button>
                <x-button type="button" wire:click="sa2Egral()">Error Gral</x-button>
            </div>

        </div>

        <div class="bg-gray-300 rounded-md shadow-md h-40 p-2 w-8/12 block">
            <div>
                Searchbox conectado a tabla permisos (buscar: grupo, simple, noticias )
                <livewire:test.search-box-test id="boxTest" listener="searchBoxTestEscucha"/>
            </div>
            <div class="pt-4">
                Aqui id de lo seleccionado: <strong>{{$searchBoxResultado}}</strong>
            </div>
        </div>

        </div>
    </slot>
</x-box-titulo>
