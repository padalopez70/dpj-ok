<?php

namespace App\Http\Livewire\Sistema\AbmDocumento;

use Livewire\Component;
use Livewire\WithFileUploads;



class Documentos extends Component
{
    use WithFileUploads;
    public $id_novedad;
    public $archivo;
    public function mount()
    {
        $this->id_novedad = request('id');

    }

    public function render()
    {
        return view('livewire.sistema.abm-documento.documentos');
    }


}
