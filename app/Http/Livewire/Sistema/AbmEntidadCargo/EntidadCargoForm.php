<?php

namespace App\Http\Livewire\Sistema\AbmEntidadCargo;



use App\Models\EntidadCargo;
use App\Models\Entidad;
use App\Models\Cargo;
use App\Models\Novedad;
use App\Lib\Sistema\Chequeos;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class EntidadCargoForm extends Component
{

    use WithFileUploads;
        //public Novedad $fila;
    public $id_novedad;
    protected $listeners = ['RefrescarDocumentos' =>' render', 'ResetearCargoVigente'];


    //public $path=[];
    public $nombre_original;
    public $nombre_entidad="";
    public $path;
    public $archivo;
    public $entidad_cargo;
    public $cargos;
    public $fila;
    public $cadena_documentos=[];
    public $tiene_estatuto;
    public $tiene_personeria;
    public $tiene_asamblea;

    public $vector_tipo_documento = [
        ['id' => '1', 'texto' => 'Estatuto'],
        ['id' => '2', 'texto' => 'Resolución de Personería Jurídica'],
        ['id' => '3', 'texto' => 'Ultima acta asamblea'],
        ['id' => '4', 'texto' => 'Otro']
      ];

    public function render()
    {

        return view('livewire.sistema.abm-entidad-cargo.cargo-form');
    }

    public function mount()
    {
        $this->entidad_cargo= new EntidadCargo();
        $this->id_novedad = request('id');


/*        $this->fila=Novedad::where('novedades.id', $this->id_novedad)
        ->leftJoin('entidades AS u', 'u.id', 'novedades.id_entidad')
        ->first()->toArray();
        $this->nombre_entidad = $this->fila['denominacion'];
*/
        $this->fila=Entidad::where('entidades.id', $this->id_novedad)
        //->leftJoin('entidades AS u', 'u.id', 'entidad_documentos.id_entidad')
        ->first()->toArray();
        $this->nombre_entidad = $this->fila['denominacion'];

        $this->cargos=Cargo::get()->toArray();



        $this->path = Route::currentRouteName();
        $this->view = 'sis.entidades.index';

        //dd($vector);
    }


    public function limpiarForm()
    {
        //$this->reset(['documento.path',' documento.comentario'  ]);

        $this->entidad_cargo->nombre = "";
        $this->entidad_cargo->fecha_asuncion = "";
        $this->entidad_cargo->celular = "";
        $this->entidad_cargo->dni = "";
        $this->entidad_cargo->email = "";

    }
    public function rules()
    {
        return [

            'entidad_cargo.nombre' => 'required',
            'entidad_cargo.cargo_id' => 'required',
            'entidad_cargo.fecha_asuncion' => 'required',
            'entidad_cargo.dni' => 'required',
            'entidad_cargo.celular' => 'required',
            'entidad_cargo.email' => 'required'
            //'archivo' => 'max:2048|mimes:pdf,jpg,jpeg,png,txt,doc,docx' // 1MB Max

        ];
    }


    protected $messages = [
    ];

    protected $validationAttributes = [
    ];

/*     public function updated($propertyName)
    {
        //funcion para ver en tiempo real si algo es actualizado, ej:
        //$this->validateOnly($propertyName);
    } */

    public function guardar()
    {
        $this->validate();

       //dump('tiene');
/*         if(Chequeos::TieneDocumentoTipificado($this->id_novedad,  $this->documento->tipo_documento)){
         $this->dispatchBrowserEvent('informar', [
             'title' => 'Atención!',
             'html' => 'Ya tiene vinculado este tipo de documento: '.Chequeos::DisplayDocTip($this->documento->tipo_documento),
             'emit' => 'CualquierCosa'
         ]); */
         if(1==2){
            $this->dispatchBrowserEvent('informar', [
                'title' => 'Atención!',
                'html' => 'Ya tiene vinculado este tipo de documento: '.Chequeos::DisplayDocTip($this->documento->tipo_documento),
                'emit' => 'CualquierCosa'
            ]);
        }
        else
        {

/*         $archivo = $this->archivo->storePublicly('public/docs/'.$this->id_novedad.'/');
        $archivo_hash = pathinfo($this->archivo->hashName(), PATHINFO_FILENAME).".".$this->archivo->extension();
        $this->nombre_original= $this->archivo->getClientOriginalName();
        $this->documento->path=$archivo_hash;
 */

        try {

            //$this->noticia->user_id = Auth::user()->id;
            $this->entidad_cargo->id_novedad=$this->id_novedad;
            //$this->documento->comentario='archivo: '.PATHINFO_FILENAME.'<br> '.$this->documento->comentario;
            $this->entidad_cargo->nombre;
            $this->entidad_cargo->fecha_asuncion;
            $this->entidad_cargo->cargo_id;
            $this->entidad_cargo->vigente=1;
            //dd($this->entidad_cargo->id_novedad);

            EntidadCargo::where('id_novedad', $this->id_novedad)
            ->where('cargo_id', $this->entidad_cargo->cargo_id)
            ->update(['VIGENTE' => 0]);
            //$this->emit( 'ResetearCargoVigente',$this->id_novedad, $this->entidad_cargo->cargo_id );
            $this->entidad_cargo->save();

            $this->entidad_cargo= new EntidadCargo;

            $this->dispatchBrowserEvent('guardado');
            //$this->emit(event:'ActualizarDocumentosRequeridos');
           // $this->emit( 'ActualizarDocumentosRequeridos',$this->id_novedad );
            $this->emit(event:'RefrescarDocumentos');
            //return redirect(url()->current());



            if (strstr($this->path, '.edit')) {
               // $this->redirectRoute($this->view);
            }
            else{
                //no limpio debido a que se carga una noticia a la vez
                $this->limpiarForm();
                //$this->redirectRoute($this->view);
            }

        } catch (Exception $e) {
            //dump ($e);
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }

        }

    }// de la funcion


    public function ResetearCargoVigente($id_novedad, $id_cargo)
    {
        EntidadCargo::where('id_novedad', $id_novedad)
    ->where('cargo_id', $id_cargo)
    ->update(['VIGENTE' => 0]);
    }// del funcion

}// de la clase
