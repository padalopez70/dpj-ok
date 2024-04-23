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

    @if (isset($data['mostrar_docs']) && (Permisos::control('1|203|205') || Permisos::control(203) ))
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


    <!-- CARGAR GDE -->

    @if (isset($data['gde']) && (Permisos::control('1|202|205')))
    @if($data['gde_tipo'] == 'vista' && $data['genera_gde']==1)

     <a title="CARGAR GDE" href="{{route($data['gde'],$data['id'])}}"><i class="fa-brands fa-google"></i>
  {{--   <a title="IMPRIMIR CARATULA" href="imprimir_caratula.php?id={{$data['id']}}" target="_blank"><i class="far fa-lg fa-file"></i> --}}
     </a>


    <!-- edicion modal -->
    @elseif($data['mostrar_doc_tipo'] == 'modal')
    <a title="EDITAR" href="#">
        @php if(empty($data['accion']))$data['accion']='edit' @endphp
        <x-ico2 name="queue-list" onclick="Livewire.emit('openModal', '{{$data['edit']}}', {{ json_encode(['data' => $data]) }})" />
    </a>
    @endif
@endif


    <!-- IMPRIMIR CARATULA -->

    @if (isset($data['imprimir_caratula']) && (Permisos::control('1|200|205')))
    @if($data['imprimir_caratula_tipo'] == 'vista')
     <a title="IMPRIMIR CARATULA" href="{{route($data['imprimir_caratula'],$data['id'])}}"><i class="fa fa-print fa-1x"></i>
  {{--   <a title="IMPRIMIR CARATULA" href="imprimir_caratula.php?id={{$data['id']}}" target="_blank"><i class="far fa-lg fa-file"></i> --}}
    </a>
    <!-- edicion modal -->
    @elseif($data['mostrar_doc_tipo'] == 'modal')
    <a title="EDITAR" href="#">
        @php if(empty($data['accion']))$data['accion']='edit' @endphp
        <x-ico2 name="queue-list" onclick="Livewire.emit('openModal', '{{$data['edit']}}', {{ json_encode(['data' => $data]) }})" />
    </a>
    @endif
@endif


@if (isset($data['editNovedad']) && (Permisos::control('1|200|205')  ))
@if($data['editTipo'] == 'vista')
<a title="EDITAR" href="{{route($data['editNovedad'],$data['id'])}}">
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

{{-- solicitud_nombre_entidad --}}
<!-- edicion SOLICITUD -->
@if (isset($data['crearEntidad']) && (Permisos::control('1|204|205')) && ($data['solicitud_pj_creada']!=1) && ($data['solicitud_pj_aprobada']==1))
@if($data['editTipo'] == 'vista')

        <a title="CREAR ENTIDAD" href="{{ route('sis.entidades.create', ['nombre_temporal' => $data['solicitud_nombre_entidad'], $data['id']]) }}">
            <x-ico2 name="arrow-right" />
        </a>
@endif
@endif

  @if (isset($data['editSolicitud']) && (Permisos::control('1|204|205')) )
@if($data['editTipo'] == 'vista')
<a title="EDITAR" href="{{route($data['editSolicitud'],$data['id'])}}">
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
    @if (isset($data['delete']) && (Permisos::control('1|205')) )
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

{{-- <div class="table-row  p-1 divide-x divide-gray-100 text-sm text-gray-900 bg-gray-50">

    <div class="col-2 px-6 py-2 table-col-span-3  text-center  whitespace-no-wrap text-sm text-gray-900 px-6 py-2">1  </div>
    <div class="colspan-2 px-6 py-2    text-left  whitespace-no-wrap text-sm  px-6 py-2" style="width: 66.67%;">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse{{$data['id']}}" aria-expanded="false" aria-controls="collapse{{$data['id']}}">
            {{$data['id']}}
            </button>
         <div id="collapse{{$data['id']}}" class="collapse">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </div>
    </div>

    <div class="col-3 px-6 py-2   text-left  whitespace-no-wrap text-sm text-gray-900 px-6 py-2"> 3  </div>
    <div class="col-3 px-6 py-2   text-left  whitespace-no-wrap text-sm text-gray-900 px-6 py-2"> 4</div>


    <div class="table-cell px-6 py-2   text-left  whitespace-no-wrap text-sm text-gray-900 px-6 py-2 bg-success" >sin cerrar
    <div class="flex justify-center space-x-2 bg-info">veamos</div>
 --}}

 <div class="table-row p-0 divide-x divide-gray-100 text-sm text-gray-900 bg-gray-50">

    <div class="table-cell px-0 py-0 table-col-span-3  text-center  whitespace-no-wrap text-sm text-gray-900 ">
       {{--  <button class="btn btn-primary p-1 mt-0"  type="button" data-toggle="collapse" data-target="#collapse{{$data['id']}}" aria-expanded="false" aria-controls="collapse{{$data['id']}}">
            &nbsp;&nbsp;&nbsp;&nbsp;
        </button> --}}
      </div>
    <div class="table-cell p-0 mx-0 col-span-3     text-left  whitespace-no-wrap text-sm" style="width: 50.67%;">

         <div id="collapse{{$data['id']}}" class="collapse  px-0 p-0">
            <em>Domicilio:</em> {{$data['domicilio']}}<br>
            <em>Teléfono:</em> {{$data['telefono']}}<br>

          </div>
    </div>

    <div  style="width: 20%;" class="table-cell px-0 py-0   text-left  whitespace-no-wrap text-sm text-gray-900">   </div>
    <div class="table-cell px-6 py-2   text-left  whitespace-no-wrap text-sm text-gray-900"> </div>


    <div class="table-cell px-0 py-0   text-left  whitespace-no-wrap text-sm text-gray-900" >
    <div class="flex justify-center space-x-2 bg-info"></div>

@endif

