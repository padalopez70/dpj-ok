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



    <!-- mostrar docuemtnso -->

    @if (isset($data['mostrar_docs']))
    @if($data['mostrar_doc_tipo'] == 'vista')
    <a title="VER DOCUMENTOS VINCULADOS" href="{{route($data['mostrar_docs'],$data['id'])}}"><i class="far fa-lg fa-file"></i>
    </a>
    <!-- edicion modal -->
    @elseif($data['mostrar_doc_tipo'] == 'modal')
    <a title="EDITAR" href="#">
        @php if(empty($data['accion']))$data['accion']='edit' @endphp
        <x-ico2 name="queue-list" onclick="Livewire.emit('openModal', '{{$data['edit']}}', {{ json_encode(['data' => $data]) }})" />
    </a>
    @endif
@endif



    <!-- edicion tradicional -->

   @if (isset($data['edit']))
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


    <!-- eliminar -->
    @if (isset($data['delete']))
        @if($data['deleteTipo'] == 'tabla')
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

    <!-- mostrar docuemtnso -->

     @if (isset($data['mostrar_info']))
            @if($data['mostrar_info_tipo'] == 'vista')
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse{{$data['id']}}" aria-expanded="false" aria-controls="collapse{{$data['id']}}">
                {{$data['id']}}
                </button>


            <!-- edicion modal -->
            @elseif($data['mostrar__info_tipo'] == 'modal')
            <a title="EDITAR" href="#">
                @php if(empty($data['accion']))$data['accion']='edit' @endphp
                <x-ico2 name="queue-list" onclick="Livewire.emit('openModal', '{{$data['edit']}}', {{ json_encode(['data' => $data]) }})" />
            </a>
            @endif
    @endif


</div>







 @if (isset($data['mostrar_info']))

</div>
</div>



<div class="table-row p-1 divide-x divide-gray-100 text-sm text-gray-900 bg-gray-50">

    <div class="table-cell px-6 py-2 table-col-span-3  text-center  whitespace-no-wrap text-sm text-gray-900 px-6 py-2">1  </div>
    <div class="table-cell px-6 py-2    text-left  whitespace-no-wrap text-sm text-gray-900 px-6 py-2">
         <div id="collapse{{$data['id']}}" class="collapse">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </div>
    </div>

    <div class="table-cell px-6 py-2   text-left  whitespace-no-wrap text-sm text-gray-900 px-6 py-2"> 3  </div>
    <div class="table-cell px-6 py-2   text-left  whitespace-no-wrap text-sm text-gray-900 px-6 py-2"> 4</div>


    <div class="table-cell px-6 py-2   text-left  whitespace-no-wrap text-sm text-gray-900 px-6 py-2 bg-success" >sin cerrar
    <div class="flex justify-center space-x-2 bg-info">veamos</div>


@endif

