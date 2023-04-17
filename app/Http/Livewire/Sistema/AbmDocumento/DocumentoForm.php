<?php

namespace App\Http\Livewire\Sistema\AbmDocumento;


use App\Models\Documento;
use App\Models\Entidad;
use App\Models\Novedad;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class DocumentoForm extends Component
{

    use WithFileUploads;
    public Documento $documento;
    public Novedad $fila;
    public $id_novedad;
    protected $listeners = ['RefrescarDocumentos' =>' render'];
    //public $path=[];
    public $nombre_original;
    public $nombre_entidad="";
    public $path;
    public $archivo;

    public function render()
    {

        return view('livewire.sistema.abm-documento.documento-form');
    }

    public function mount(Documento $documento)
    {

        $this->id_novedad = request('id');
        $this->documento = $documento;
/*
        $this->fila=Novedad::where('novedades.id', $this->id_novedad)
        ->leftJoin('entidades AS u', 'u.id', 'novedades.id_entidad')
        ->first();
        $this->nombre_entidad = $this->fila->denominacion;
*/
        $this->path = Route::currentRouteName();
        $this->view = 'sis.novedades.index';
    }


    public function limpiarForm()
    {
        //$this->reset(['documento.path',' documento.comentario'  ]);

        $this->documento->path = "";
        $this->documento->comentario = "";

    }
    public function rules()
    {
        return [
            'documento.path' => '',
            'documento.comentario' => '',
            'archivo' => 'max:2048|mimes:pdf,jpg,jpeg,png,txt,doc,docx' // 1MB Max

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
        //dd('hola');
        //$this->path->store('docs');
        $archivo = $this->archivo->storePublicly('public/docs/'.$this->id_novedad.'/');
        $archivo_hash = pathinfo($this->archivo->hashName(), PATHINFO_FILENAME).".".$this->archivo->extension();
        //$docE->archivo_original = $this->archivo->getClientOriginalName();
        //$link = Storage::url('doc/'.$archivo_hash);
        $this->nombre_original= $this->archivo->getClientOriginalName();
        //dd($archivo_hash,$archivo,$this->nombre_original);

        $this->documento->path=$archivo_hash;
        //dd($archivo_hash,$archivo,$this->nombre_original);

        //$this->validate();

        try {

            //$this->noticia->user_id = Auth::user()->id;
            $this->documento->id_novedad=$this->id_novedad;
            //$this->documento->comentario='archivo: '.PATHINFO_FILENAME.'<br> '.$this->documento->comentario;
            $this->documento->comentario;
            $this->documento->save();
            $this->documento= new Documento;

            $this->dispatchBrowserEvent('guardado');
            $this->emit(event:'RefrescarDocumentos');

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
}
