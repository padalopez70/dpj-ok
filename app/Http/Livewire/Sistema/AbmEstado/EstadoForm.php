<?php

namespace App\Http\Livewire\Sistema\AbmEstado;


use App\Models\Estado;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class EstadoForm extends Component
{

    public Estado $estado;



    public function render()
    {

        return view('livewire.sistema.abm-estado.estado-form');
    }

    public function mount(Estado $estado)
    {
        $this->estado = $estado;
               $this->path = Route::currentRouteName();
        $this->view = 'sis.estados.index';
    }

    public function limpiarForm()
    {
        $this->estado->denominacion_estado = "";

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
            'estado.denominacion_estado' => 'required'
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
            $this->estado->denominacion_estado;

            $this->estado->save();

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
