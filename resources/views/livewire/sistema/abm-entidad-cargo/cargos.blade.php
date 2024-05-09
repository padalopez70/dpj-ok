<div class="container">
    <div class="row">
        <div class="col-12 ">

       <livewire:sistema.abm-entidad-cargo.entidad-cargo-form :id_novedad="$id_novedad"/>
        </div>

        <div class="col-12">

             {{-- <livewire:sistema.abm-entidad-documento.entidad-documentos-tipificados  :id_novedad="$id_novedad"/> --}}
             <div class="col-6">

                <div class="flex space-x-1 h-10 m-1">
{{--
                    <label for="estado uno" class="{{($estatuto != null)? "bg-success":"bg-danger"}} p-2">Estatuto</label>
                    <label for="estado uno" class="{{($personeria != null)? "bg-success":"bg-danger"}} p-2">Personería</label>
                    <label for="estado uno"  class="{{($asamblea != null)? "bg-success over":"bg-danger"}} p-2">Asamblea</label>
 --}}
                </div>
             </div>
<div class=" button p-2">

    {{--
        <a href="#" wire:click="actualizarSinRepetidos($id_novedad, 'sinRepetidos')">Sin repetidos</a>
 --}}
    <x-switch-ver titulo="Solo Vigentes" :estado="session('switch_soloVigentes')" funcion="switchSoloVigentes" class="w-64"/>
</div>
 <livewire:sistema.abm-entidad-cargo.entidad-cargos-tabla :id_novedad="$id_novedad" :opcion="'sinrepetidos'"/>


        </div>
    </div>
</div>

{{--
    <livewire:sistema.abm-entidad-cargo.entidad-cargos-tabla  :id_novedad="$id_novedad, $opcion"/>
 --}}
