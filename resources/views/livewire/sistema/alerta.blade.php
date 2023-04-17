
<!-- return view('livewire.sistema.alerta', ['data' => ['alertaTipo' => 'permisos']]); -->

<div>

    <!-- EN CONSTRUCCION -->
    @if ($data['alertaTipo'] == 'construccion')
    <div class="grid place-items-center px-12 py-12 mx-auto h-56 font-bold">
        <x-ico2 name="wrench-screwdriver" class="w-20 h-20"/>
        <div class="pt-4 text-2xl">MODULO EN CONSTRUCCION</div>
    </div>
    <!-- EN CONSTRUCCION -->

    <!-- EN MANTENIMIENTO -->
    @elseif ($data['alertaTipo'] == 'mantenimiendo')
        <div class="grid place-items-center px-12 py-12 mx-auto h-56 font-bold">
            <x-ico2 name="wifi" class="w-20 h-20"/>
            <div class="pt-4 text-2xl">CONEXION CON RRHH</div>
            <div class="text-base text-red-600">Esto puede demorar mas de lo normal</div>
        </div>
    <!-- EN MANTENIMIENTO -->

        <!-- EN MANTENIMIENTO -->
        @elseif ($data['alertaTipo'] == 'permisos')
        <div class="grid place-items-center px-12 py-12 mx-auto h-56 font-bold">
            <x-ico2 name="lock-closed" class="w-20 h-20"/>
            <div class="pt-4 text-2xl">PERMISOS INSUFICIENTES</div>
            <div class="text-base text-red-600">Ud. No posee los permisos suficientes para la acción que desea realizar.</div>
        </div>
    <!-- EN MANTENIMIENTO -->

    <!-- ALERTA DESCONOCIDA -->
    @else
        <div class="grid place-items-center px-12 py-12 mx-auto h-56 font-bold">
            <x-ico2 name="bell" class="w-20 h-20"/>
            <div class="pt-4 text-2xl">ALERTA DESCONOCIDA</div>
        </div>
    <!-- ALERTA DESCONOCIDA -->

    @endif

</div>
