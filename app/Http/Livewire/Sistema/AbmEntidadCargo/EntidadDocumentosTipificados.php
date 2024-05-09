<?php

namespace App\Http\Livewire\Sistema\AbmEntidadDocumento;

use App\Models\EntidadDocumento;
use Livewire\Component;
use App\Lib\Sistema\Chequeos;


class EntidadDocumentosTipificados extends Component
{

    public $cadena_documentos=[];
    public $tiene_estatuto;
    public $tiene_personeria;
    public $tiene_asamblea;
    //protected $listeners = [ 'ActualizarDocumentosRequeridos' =>'render'];


    public function render()
    {
        print '<script>alert(" controlador DOCUMENTOS TIPIFICADOS"); </script>';
        $this->id_novedad = request('id');
        $this->cadena_documentos= Chequeos::EntidadDocumentos($this->id_novedad);
        $vector = explode("**",  $this->cadena_documentos);
        $this->tiene_estatuto=$vector[0];
        $this->tiene_personeria=$vector[1];
        $this->tiene_asamblea=$vector[2];

        return view('livewire.sistema.abm-entidad-documento.documentos-tipificados');
    }


    public function mount()
    {


    }


}
