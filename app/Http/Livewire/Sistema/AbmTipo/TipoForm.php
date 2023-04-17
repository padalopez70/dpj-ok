<?php

namespace App\Http\Livewire\Sistema\AbmTipo;


use App\Models\Tipo;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;

class TipoForm extends Component
{

    public Tipo $tipo;
    use WithFileUploads;
    public $archivo;



    public function render()
    {

        return view('livewire.sistema.abm-tipo.tipo-form');
    }

    public function mount(Tipo $tipo)
    {
        $this->tipo = $tipo;
               $this->path = Route::currentRouteName();
        $this->view = 'sis.tipos.index';
    }

    public function limpiarForm()
    {
        $this->tipo->denominacion_tipo = "";

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
            'tipo.denominacion_tipo' => 'required'
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
            $this->tipo->denominacion_tipo;

            $this->tipo->save();

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
