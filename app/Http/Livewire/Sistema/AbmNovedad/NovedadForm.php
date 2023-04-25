<?php

namespace App\Http\Livewire\Sistema\AbmNovedad;


use App\Models\Novedad;
use App\Models\Entidad;
use App\Models\TipoNovedad;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class NovedadForm extends Component
{

    public Novedad $novedad;
    public $puedo_cambiar_entidad="";


    public function render()
    {

        return view('livewire.sistema.abm-novedad.novedad-form');
    }

    public function mount(Novedad $novedad)
    {
        $this->novedad = $novedad;
        $this->entidades=Entidad::get()->toArray();
        $this->tipos_novedades=TipoNovedad::get()->toArray();

        //if($this->novedad->id!= null) $this->puedo_cambiar_entidad=" disabled: true, "; else $this->puedo_cambiar_entidad=" disabled=false, ";
        if($this->novedad->id== null) $this->puedo_cambiar_entidad="si"; else $this->puedo_cambiar_entidad="no";

        // dd($puedo_cambiar_entidad);
        //dd($this->novedad->id);
        //para mostrar simple-select va con toArray();
        //$this->tipos = ['INFO','EXITO','ALARMA','GENERAL'];


        $this->path = Route::currentRouteName();
        $this->view = 'sis.novedades.index';
    }

    public function limpiarForm()
    {
        $this->novedad->novedad_descripcion = "";
        $this->novedad->id_entidad = "";
        $this->novedad->id_tipo_novedad = "";

/*         $this->entidad->id_tipo_entidad = "";
        $this->entidad->domicilio = "";
        $this->entidad->telefono = "";
 */
    }
    public function rules()
    {
        return [
            'novedad.novedad_descripcion' => 'required',
            'novedad.id_entidad' => 'required',
            'novedad.id_tipo_novedad' => 'required',
            'novedad.numero' => 'required',
            'novedad.codigo' => 'required',
            'novedad.anio' => 'required',
            'novedad.fecha' => 'required'

/*             'entidad.legajo' => 'required',
            'entidad.domicilio' => 'required',
            'entidad.telefono' => 'required'
 */
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

            DB::beginTransaction();
            $this->novedad->user_id = Auth::user()->id;
            $this->novedad->novedad_descripcion;
            $this->novedad->id_entidad;
            $this->novedad->id_tipo_novedad;
            $this->novedad->numero;
            $this->novedad->codigo;
            $this->novedad->anio;
/*
            $this->entidad->legajo;
            $this->entidad->domicilio;
            $this->entidad->telefono; */
            $this->novedad->save();

            $this->dispatchBrowserEvent('guardado');

            if (strstr($this->path, '.edit')) {
                $this->redirectRoute($this->view);
            }
            else{
                //no limpio debido a que se carga una noticia a la vez
                //$this->limpiarForm();
                $this->redirectRoute($this->view);
            }
            DB::commit();

        } catch (Exception $e) {
            dump ($e);
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
            DB::rollBack();
        }
    }
}
