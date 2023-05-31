<?php

namespace App\Http\Livewire\Sistema\AbmEntidadDocumento;

use App\Models\EntidadDocumento;
use Livewire\Component;
use App\Lib\Sistema\Chequeos;
use App\Models\Entidad;
use Livewire\WithFileUploads;




class EntidadDocumentos extends Component
{
    use WithFileUploads;
    public $id_novedad;
    public $archivo;
    public $cadena_documentos=[];
    public $tiene_estatuto;
    public $tiene_personeria;
    public $tiene_asamblea;
    protected $listeners = [ 'ActualizarDocumentosRequeridos'];


    public function render()
    {

            //print'<script> alert ("Controlador PADRE");</script>';
             //$this->id_novedad = request('id');
             //$this->cadena_documentos= Chequeos::EntidadDocumentos($this->id_novedad);
             //$aux="bg-success*bg-success*bg-danger";
             //$vector = explode("**",  $this->cadena_documentos);
             //$vector = explode("*", "bg-success*bg-success*bg-danger");
             //$this->tiene_estatuto=$vector[0];
             //$this->tiene_estatuto=0;
             //$this->tiene_personeria=$vector[1];
             //$this->tiene_asamblea=$vector[2];

        return view('livewire.sistema.abm-entidad-documento.documentos');
    }

    public function mount()
    {
        $this->id_novedad = request('id');

        $this->entidad = Entidad::where('id',$this->id_novedad)->first();
        $this->ActualizarDocumentosRequeridos($this->id_novedad);
    }

    public function ActualizarDocumentosRequeridos($id_novedad)
    {
        $this->estatuto = EntidadDocumento::where('id_novedad',$id_novedad)
        ->where('tipo_documento', 1)
        ->first();

        $this->personeria = EntidadDocumento::where('id_novedad',$id_novedad)
        ->where('tipo_documento', 2)
        ->first();

        $this->asamblea = EntidadDocumento::where('id_novedad',$id_novedad)
        ->where('tipo_documento', 3)
        ->first();
    }


}
