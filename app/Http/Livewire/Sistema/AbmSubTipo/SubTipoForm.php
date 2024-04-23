<?php

namespace App\Http\Livewire\Sistema\AbmSubTipo;


use App\Models\SubTipo;
use App\Models\Tipo;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubTipoForm extends Component
{

    public Subtipo $subtipo;
    use WithFileUploads;
    public $archivo;



    public function render()
    {

        return view('livewire.sistema.abm-subtipo.subtipo-form');
    }

    public function mount(SubTipo $subtipo)
    {
        $this->subtipo = $subtipo;
        $this->path = Route::currentRouteName();
        $this->tipos_entidades=Tipo::get()->toArray();
        $this->view = 'sis.subtipos.index';
    }

    public function limpiarForm()
    {
        $this->subtipo->nombre = "";

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
            'subtipo.nombre' => 'required',
            'subtipo.tipo_id' => 'required'
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
            $this->subtipo->nombre;
            $this->subtipo->tipo_id;

            $this->subtipo->save();

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
