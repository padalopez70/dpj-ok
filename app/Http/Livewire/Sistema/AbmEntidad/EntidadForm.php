<?php

namespace App\Http\Livewire\Sistema\AbmEntidad;

use App\Lib\Sistema\Chequeos;
use App\Models\Departamento;
use App\Models\Entidad;
use App\Models\Estado;
use App\Models\Localidad;
use App\Models\SubTipo;
use App\Models\EntidadSubtipo;
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


    //nuevo
    public $subtipos =[];
    public $entidad_subtipos = [];
    public $nombre_temporal;
    public $id_solicitud;




    public function render()
    {

        return view('livewire.sistema.abm-entidad.entidad-form');
    }

    public function mount(Entidad $entidad, $nombre_temporal=null, $id_solicitud=null)
    {
        $this->entidad = $entidad;

                      // Verifica si la instancia de Novedad es nueva o existente
                      if(!$this->entidad->id){
                        //dd($this->novedad->id);
                        $this->label_formulario ="Crear Entidad";
                        $this->entidad->denominacion=$nombre_temporal;

                       // $this->novedad->anio = 6666; // Configura el valor predeterminado para crear
                    }
                    else $this->label_formulario ="Editar Entidad";




        $this->estados=Estado::get()->toArray();

        $this->departamentos=Departamento::where('provincia_id', '21')
        ->orderBy('departamento','ASC')->get()->toArray();
        $this->DepartamentoSeleccionado=$this->entidad->id_departamento;
        $this->localidades=Localidad::where('departamento_id', $this->DepartamentoSeleccionado)
        ->orderBy('localidad','ASC')
        ->get()->toArray();
        $this->localidad_seleccionada=$this->entidad->id_localidad;


        //tipo y subtipo
        $this->tipos=Tipo::select('id','denominacion_tipo AS nombre')->get()->toArray();
        if($this->entidad->id != null){
            $this->subtipos=Subtipo::where('tipo_id',$this->entidad->id_tipo_entidad)->get()->toArray();
            $this->entidad_subtipos = EntidadSubtipo::where('entidad_id',$this->entidad->id)->pluck('subtipo_id');
        }


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
        $this->entidad->email = "";

        /*
        $this->noticia->titulo = "";
        $this->noticia->noticia = "";
        $this->noticia->fecha = "";
        $this->noticia->fecha_inicio = "";
        $this->noticia->fecha_fin = "";
        */
    }

    public function updatedEntidadIdTipoEntidad($tipo_id)
    {

       $this->subtipos=Subtipo::where('tipo_id',$tipo_id)->get()->toArray();
       $this->entidad_subtipos=[];
    }

    public function rules()
    {
        return [
            'entidad.denominacion' => 'required',
            'entidad.id_tipo_entidad' => 'required',
            'entidad.id_estado' => 'required',
            'entidad.legajo' => 'required',
            'entidad.email' => 'required',
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
            $this->entidad->email;
            $this->entidad->domicilio;
            $this->entidad->telefono;
            //dump($this->id_departamento,$this->id_localidad);

            $this->entidad->save();

            //borro los subtipos de la entidad y las vuelvo a cargar
            EntidadSubtipo::where('entidad_id', $this->entidad->id)->delete();
            foreach ($this->entidad_subtipos as $subtipo_id) {
                $ne = new EntidadSubtipo();
                $ne->entidad_id = $this->entidad->id;
                $ne->subtipo_id =  $subtipo_id;
                $ne->save();
            }

            //si vengo de SOLICITUDES DE PERSONERIA JURICIDA ACTUALIZO EL REGISTRO
            if ($this->id_solicitud) Chequeos::Actualizar_Solicitud_PJ($this->id_solicitud);

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

