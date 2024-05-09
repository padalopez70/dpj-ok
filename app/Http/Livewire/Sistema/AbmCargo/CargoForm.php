<?php

namespace App\Http\Livewire\Sistema\AbmCargo;


use App\Models\Cargo;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class CargoForm extends Component
{

    public Cargo $cargo;



    public function render()
    {

        return view('livewire.sistema.abm-cargo.cargo-form');
    }

    public function mount(Cargo $cargo)
    {
        $this->cargo = $cargo;
        $this->path = Route::currentRouteName();
        $this->view = 'sis.cargo.index';

        $this->opciones_gde = [
            ['id' => 1, 'texto' => 'SI'],
            ['id' => 2, 'texto' => 'NO']
        ];
        $this->aux_genera_gde =1;


        //dd($this->tipoNovedad);
    }

    public function limpiarForm()
    {
        $this->cargo->nombre = "";

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
            'cargo.nombre' => 'required',
            'cargo.peso' => 'required'
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
            $this->cargo->nombre;
            $this->cargo->peso;

            $this->cargo->save();

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
