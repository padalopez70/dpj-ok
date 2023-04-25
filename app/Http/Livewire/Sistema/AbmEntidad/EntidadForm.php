<?php

namespace App\Http\Livewire\Sistema\AbmEntidad;


use App\Models\Departamento;
use App\Models\Entidad;
use App\Models\Estado;
use App\Models\Localidad;
use App\Models\Tipo;


use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class EntidadForm extends Component
{

    public Entidad $entidad;
    public $DepartamentoSeleccionado;
    public $localidad_seleccionada = null;
    public $localidades;




    public function render()
    {

        return view('livewire.sistema.abm-entidad.entidad-form');
    }

    public function mount(Entidad $entidad)
    {
        $this->entidad = $entidad;
        $this->tipos=Tipo::get()->toArray();
        $this->estados=Estado::get()->toArray();

        $this->departamentos=Departamento::where('provincia_id', '21')
        ->orderBy('departamento','ASC')->get()->toArray();
        $this->DepartamentoSeleccionado=$this->entidad->id_departamento;
        $this->localidades=Localidad::where('departamento_id', $this->DepartamentoSeleccionado)
        ->orderBy('localidad','ASC')
        ->get()->toArray();
        $this->localidad_seleccionada=$this->entidad->id_localidad;

        //para mostrar simple-select va con toArray();
        //$this->tipos = ['INFO','EXITO','ALARMA','GENERAL'];


        $this->path = Route::currentRouteName();
        $this->view = 'sis.entidades.index';
    }

    public function limpiarForm()
    {
        $this->entidad->denominacion = "";
        $this->entidad->legajo = "";
        $this->entidad->id_tipo_entidad = "";
        $this->entidad->id_estado = "";
        $this->entidad->domicilio = "";
        $this->entidad->telefono = "";

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
            'entidad.denominacion' => 'required',
            'entidad.id_tipo_entidad' => 'required',
            'entidad.id_estado' => 'required',
            'entidad.legajo' => 'required',
            'entidad.domicilio' => 'required',
            'entidad.telefono' => 'required',
            'entidad.id_localidad' => 'required',
            'entidad.id_departamento' => 'required'

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

        $this->entidad->id_departamento=$this->DepartamentoSeleccionado;
        $this->entidad->id_localidad=$this->localidad_seleccionada;

        $this->validate();

        try {

            //$this->noticia->user_id = Auth::user()->id;
            $this->entidad->denominacion;
            $this->entidad->id_tipo_entidad;
            $this->entidad->id_estado;
            $this->entidad->legajo;
            $this->entidad->domicilio;
            $this->entidad->telefono;
            //dump($this->id_departamento,$this->id_localidad);

            $this->entidad->save();


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

    public function updatedDepartamentoSeleccionado($id_departamento){

        $this->DepartamentoSeleccionado=$id_departamento;
        $this->localidades=Localidad::where('departamento_id', $id_departamento)->get()->toArray();
        //dump($id_departamento);
    }

}

