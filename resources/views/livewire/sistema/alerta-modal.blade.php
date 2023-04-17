<div>

    <!-- EN CONSTRUCCION -->
    @if ($data['alertaTipo'] == 'construccion')
    <div class="grid place-items-center px-12 py-12 mx-auto h-56 font-bold">
        <x-ico2 name="wrench-screwdriver" class="w-20 h-20"/>
        <div class="pt-4 text-2xl">MODULO EN CONSTRUCCION</div>
    </div>

    <div>
        <div class="flex justify-center px-3 py-2 bg-gray-200 shadow rounded-b-md">
            <div class="space-x-2">
                <x-button wire:click="$emit('closeModal')">Aceptar</x-button>
            </div>
        </div>
    </div>
    <!-- EN CONSTRUCCION -->

    <!-- EN MANTENIMIENTO -->
    @elseif ($data['alertaTipo'] == 'mantenimiendo')
        <div class="grid place-items-center px-12 py-12 mx-auto h-56 font-bold">
            <x-ico2 name="wifi" class="w-20 h-20"/>
            <div class="pt-4 text-2xl">CONEXION CON RRHH</div>
            <div class="text-base text-red-600">Esto puede demorar mas de lo normal</div>
        </div>
        <div>
            <div class="flex justify-center px-3 py-2 bg-gray-200 shadow rounded-b-md">
                <div class="space-x-2">
                    <a href="{{route('dashboard')}}">
                        <x-button wire:click="$emit('closeModal')">Aceptar</x-button>
                    </a>
                </div>
            </div>
        </div>
    <!-- EN MANTENIMIENTO -->

        <!-- EN MANTENIMIENTO -->
        @elseif ($data['alertaTipo'] == 'permisos')
        <div class="grid place-items-center px-12 py-12 mx-auto h-56 font-bold">
            <x-ico2 name="lock-closed" class="w-20 h-20"/>
            <div class="pt-4 text-2xl">PERMISOS INSUFICIENTES</div>
            <div class="text-base text-red-600">Ud. No posee los permisos suficientes para la acción que desea realizar.</div>
        </div>
        <div>
            <div class="flex justify-center px-3 py-2 bg-gray-200 shadow rounded-b-md">
                <div class="space-x-2">
                    <x-button wire:click="$emit('closeModal')">Aceptar</x-button>
                </div>
            </div>
        </div>
    <!-- EN MANTENIMIENTO -->

    <!-- ALERTA DESCONOCIDA -->
    @else
        <div class="grid place-items-center px-12 py-12 mx-auto h-56 font-bold">
            <x-ico2 name="bell" class="w-20 h-20"/>
            <div class="pt-4 text-2xl">ALERTA DESCONOCIDA</div>
        </div>
        <div>
            <div class="flex justify-center px-3 py-2 bg-gray-200 shadow rounded-b-md">
                <div class="space-x-2">
                    <x-button wire:click="$emit('closeModal')">Aceptar</x-button>
                </div>
            </div>
        </div>
    <!-- ALERTA DESCONOCIDA -->

    @endif

</div>
