<?php

namespace App\Http\Livewire\Sistema\AbmNoticia;


use App\Models\Noticia;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class NoticiaForm extends Component
{

    public Noticia $noticia;

    public function render()
    {

        return view('livewire.sistema.abm-noticia.noticia-form');
    }

    public function mount(Noticia $noticia)
    {
        $this->noticia = $noticia;

        //para mostrar simple-select va con toArray();
        $this->tipos = ['INFO','EXITO','ALARMA','GENERAL'];


        $this->path = Route::currentRouteName();
        $this->view = 'sis.noticias.index';
    }

    public function limpiarForm()
    {
        $this->noticia->tipo = "";
        $this->noticia->titulo = "";
        $this->noticia->noticia = "";
        $this->noticia->fecha = "";
        $this->noticia->fecha_inicio = "";
        $this->noticia->fecha_fin = "";
    }
    public function rules()
    {
        return [
            'noticia.tipo' => 'required',
            'noticia.titulo' => 'required',
            'noticia.noticia' => '',
            'noticia.fecha' => 'required',
            'noticia.fecha_inicio' => 'required',
            'noticia.fecha_fin' => 'required'
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

            $this->noticia->user_id = Auth::user()->id;
            $this->noticia->save();

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
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }
    }
}
