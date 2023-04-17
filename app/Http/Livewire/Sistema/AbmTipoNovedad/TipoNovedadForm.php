<?php

namespace App\Http\Livewire\Sistema\AbmTipoNovedad;


use App\Models\TipoNovedad;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class TipoNovedadForm extends Component
{

    public TipoNovedad $tipoNovedad;



    public function render()
    {

        return view('livewire.sistema.abm-tipo-novedad.tipo-novedad-form');
    }

    public function mount(TipoNovedad $tipoNovedad)
    {
        $this->tipoNovedad = $tipoNovedad;
               $this->path = Route::currentRouteName();
        $this->view = 'sis.tiposnovedad.index';
        //dd($this->tipoNovedad);
    }

    public function limpiarForm()
    {
        $this->tipoNovedad->novedad_denominacion = "";

        /*
        $this->noticia->titulo = "";
        $this->noticia->noticia = "";
        $this->noticia->fecha = "";
        $this->noticia->fecha_inicio = "";
        $this->noticia->fecha_fin = "";
        */
    }
    public function rules()
    {
        return [
            'tipoNovedad.novedad_denominacion' => 'required'
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
            $this->tipoNovedad->novedad_denominacion;

            $this->tipoNovedad->save();

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
