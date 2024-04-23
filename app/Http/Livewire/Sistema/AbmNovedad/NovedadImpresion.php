<?php

namespace App\Http\Livewire\Sistema\AbmNovedad;


use App\Lib\Sistema\Chequeos;
use App\Models\Novedad;
use App\Models\Entidad;
use App\Models\TipoNovedad;
use App\Models\Config;
use App\Models\NovedadTipo;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class NovedadImpresion extends Component
{

    protected $listeners = ['entidadTraer'];
    public Novedad $novedad;
    public $puedo_cambiar_entidad="";


    public function render()
    {

        return view('livewire.sistema.abm-novedad.novedad-plantilla-impresion');
    }

    public function mount(Novedad $novedad)
    {
        $this->novedad = $novedad;
        $this->entidades=Entidad::select('id', 'denominacion')->limit(1000)->get()->toArray();
        $this->tipos_novedades=TipoNovedad::get()->toArray();

        $this->opciones_gde = [
            ['id' => 1, 'texto' => 'SI'],
            ['id' => 2, 'texto' => 'NO']
        ];
        $this->aux_genera_gde =1;

        $this->novedad_tipos = NovedadTipo::where('novedad_id',$this->novedad->id)->pluck('tipo_novedad_id');



         // Verifica si la instancia de Novedad es nueva o existente
        if(!$this->novedad->id){
            //dd($this->novedad->id);
            $this->label_formulario ="Crear Expediente";
            $config = Config::first(); // Obtiene el primer registro de la tabla Config
            if ($config) {
                $this->novedad['numero'] = $config->exp_nro+1;
                $this->novedad['codigo'] = $config->exp_cod;
                $this->novedad['anio'] = $config->exp_anio;
            }

           // $this->novedad->anio = 6666; // Configura el valor predeterminado para crear
        }
        else $this->label_formulario =" ";





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
        $this->novedad->genera_gde = "";

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
            'novedad.id_tipo_novedad' => '',
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
        'novedad.id_entidad' => 'Entidad',
    ];

    public function updated($propertyName)
    {
        //funcion para ver en tiempo real si algo es actualizado, ej:
        //$this->validateOnly($propertyName);
    }

    public function entidadTraer($id_entidad)
    {
        if($id_entidad != null){
            $this->novedad->id_entidad = $id_entidad;
        }
        else{
            $this->novedad->id_entidad = null;
        }
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
            //------------------- si es nuevo le asigno un numero de expediente y actualizao la tabla config
                    if(!$this->novedad->id){
                    DB::table('config')
                    ->where('id', 1)
                    ->increment('exp_nro');
                    $this->novedad->numero=DB::table('config')
                    ->where('id', 1)
                    ->value('exp_nro');
                    }

             //---------------veo si alguna de los tipos de novedades elegidos genera gde
            //$this->novedad->genera_gde=Chequeos::TiposNovedad($id, "genera_gde");
            $this->novedad->genera_gde=Chequeos::VeoSiGeneranGde($this->novedad_tipos);



            $this->novedad->save();

            //borro los subtipos de la entidad y las vuelvo a cargar
            NovedadTipo::where('novedad_id', $this->novedad->id)->delete();
            foreach ($this->novedad_tipos as $tipo_id) {
                $ne = new NovedadTipo();
                $ne->novedad_id = $this->novedad->id;
                $ne->tipo_novedad_id =  $tipo_id;
                $ne->save();
            }


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
