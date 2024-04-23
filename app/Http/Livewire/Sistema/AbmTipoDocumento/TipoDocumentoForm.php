<?php

namespace App\Http\Livewire\Sistema\AbmTipoDocumento;


use App\Models\TipoDocumento;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class TipoDocumentoForm extends Component
{

    public TipoDocumento $tipoDocumento;



    public function render()
    {

        return view('livewire.sistema.abm-tipo-documento.tipo-documento-form');
    }

    public function mount(TipoDocumento $tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
               $this->path = Route::currentRouteName();
        $this->view = 'sis.tiposdocumento.index';

/*         $this->opciones_gde = [
            ['id' => 1, 'texto' => 'SI'],
            ['id' => 2, 'texto' => 'NO']
        ];
        $this->aux_genera_gde =1; */


        //dd($this->tipoNovedad);
    }

    public function limpiarForm()
    {
        $this->tipoDocumento->denominacion_tipo_documento = "";


    }
    public function rules()
    {
        return [
            'tipoDocumento.denominacion_tipo_documento' => 'required',
            //'tipoNovedad.genera_gde' => 'required'
        ];
    }


    protected $messages = [
    ];

    protected $validationAttributes = [
    ];

    public function updated($propertyName)
    {
        //funcion para ver en tiempo real si algo es actualizado, ej:
        //$this->validateOnly($propertyName);
    }

    public function guardar()
    {

        $this->validate();

        try {

            //$this->noticia->user_id = Auth::user()->id;
            $this->tipoDocumento->denominacion_tipo_documento;
           // $this->tipoNovedad->genera_gde;

            $this->tipoDocumento->save();

            $this->dispatchBrowserEvent('guardado');

            if (strstr($this->path, '.edit')) {
                $this->redirectRoute($this->view);
            }
            else{
                //no limpio debido a que se carga una noticia a la vez
                //$this->limpiarForm();
                $this->redirectRoute($this->view);
            }

        } catch (Exception $e) {
            dump ($e);
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }
    }
}
