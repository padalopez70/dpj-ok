<!--
            Column::callback(['id'], function ($id) {
                $data = [
                    'showTipo' => false,
                    'show' => null,
                    'editTipo' => 'modal',
                    'edit' => 'abm-marca.marca-form',
                    'deleteTipo' => 'tabla',
                    'delete' => null,
                    'id' => $id,
                ];
                return view('_tbl.celda-act', ['data' => $data]);
            })
                ->excludeFromExport()
                ->unsortable()
                ->label('Acciones')
-->

<div class="flex justify-center space-x-2">

    <!-- vista -->
    @if (isset($data['show']))
        @if($data['showTipo'] == 'vista')
        <a title="VER" href="{{route($data['show'],$data['id'])}}">
            <x-ico2 name="magnifying-glass" />
        </a>
        <!-- modal -->
        @elseif($data['showTipo'] == 'modal')
        <a title="VER" href="#">
            <x-ico2 name="magnifying-glass" onclick="Livewire.emit('openModal', '{{$data['show']}}', {{ json_encode(['data' => $data]) }})" />
        </a>
        @endif
    @endif

    <!-- edicion tradicional -->

{{--     @if (isset($data['edit']))
        @if($data['editTipo'] == 'vista')
        <a title="EDITAR" href="{{route($data['edit'],$data['id'])}}">
            <x-ico2 name="pencil-square" />
        </a>
        <!-- edicion modal -->
        @elseif($data['editTipo'] == 'modal')
        <a title="EDITAR" href="#">
            @php if(empty($data['accion']))$data['accion']='edit' @endphp
            <x-ico2 name="pencil-square" onclick="Livewire.emit('openModal', '{{$data['edit']}}', {{ json_encode(['data' => $data]) }})" />
        </a>
        @endif
    @endif
 --}}

    <!-- eliminar -->

    @if (isset($data['delete']))
        @if($data['deleteTipo'] == 'tabla' && !Permisos::control(201))
        <a title="ELIMINAR" href="#">
            <x-ico2 name="trash" wire:click="confirmarEliminacion({{$data['id']}})"/>
        </a>
        @elseif($data['deleteTipo'] == 'vista')
        <a title="ELIMINAR" href="{{route($data['delete'],$data)}}">
            <x-ico2 name="trash" />
        </a>
        @elseif($data['deleteTipo'] == 'modal')
        <a title="ELIMINAR" href="#">
            <x-ico2 name="trash" onclick="Livewire.emit('openModal', '{{$data['delete']}}', {{ json_encode(['data' => $data]) }})" />
        </a>
        @endif
    @endif

</div>
