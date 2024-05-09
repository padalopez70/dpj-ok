{{--
    //EN VISTA
    <x-switch-ver titulo="FINALIZADAS" :estado="session('switch_opes_cerradas')" funcion="switchOpesCerradas" />

    //EN CONTROLADOR
    public function switchOpesCerradas()
    {
        $soc = session('switch_opes_cerradas', false);
        $soc = !$soc;
        session(['switch_opes_cerradas' => $soc]);
        $this->emit('opesTablaRefresh');
    }

    //EN TABLA
    if(session('switch_opes_cerradas') == false){
        $opes->whereNotIn('op.estado', ['CERRADA', 'CANCELADA']);
    }
--}}

@props([
    'titulo' => null,
    'estado', //si o si
    'funcion' //si o si
])

<div {!! $attributes->merge(['class' => 'flex w-48 h-10 px-1 py-1 space-x-1 border-2 border-gray-400 rounded-md']) !!}>
    <div>
        <x-button info wire:click='{{$funcion}}' class="h-7">
            @if ($estado == true)
                <x-ico2 name="eye" stroke="2" />
            @else
                <x-ico2 name="eye-slash" stroke="2"/>
            @endif
        </x-button>
    </div>
    <div class="flex items-center font-bold align-middle">
        {{$titulo}}
    </div>
</div>
