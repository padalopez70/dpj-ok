<?php

namespace App\Http\Livewire\AbmEjemplo;

use App\Models\Ejemplo;
use App\Models\EjemploTipo;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class EjemploForm extends Component
{
    protected $listeners = [
        'ejemploFormUpdate' //lo dispara EjemploTipoFormModal para actualizar el ejemplo tipo
    ];

    public Ejemplo $ejemplo;

    public function render()
    {
        return view('livewire.abm-ejemplo.ejemplo-form');
    }


    public function mount(Ejemplo $ejemplo)
    {
        $this->ejemplo = $ejemplo;
        $this->path = Route::currentRouteName();
        $this->vista = 'abm-ejemplo.ejemplos.index';
        strstr($this->path, '.create') ? $this->nuevo = true : $this->nuevo = false;

        //cargo los tipos de ejemplos
        $this->ejemplo_tipos = EjemploTipo::get()->toArray();
    }

    public function limpiarForm(){
        $this->ejemplo = new Ejemplo();
    }

    public function rules()
    {
        return [
            'ejemplo.ejemplo_tipo_id' => 'required',
            'ejemplo.nombre' => 'required|unique:ejemplos,nombre,'.$this->ejemplo->nombre,
            'ejemplo.descripcion' => 'max:200',
        ];
    }


    protected $messages = [
        'unique' => 'El Nombre ya existe.'
    ];

    protected $validationAttributes = [
        'ejemplo.ejemplo_tipo_id' => 'tipo de ejemplo'
    ];

    public function updated($propertyName)
    {
        //funcion para ver en tiempo real si algo es actualizado, ej:
        //$this->validateOnly($propertyName);
    }


    public function ejemploFormUpdate($value)
    {
        $this->ejemplo_tipos = EjemploTipo::get()->toArray();
        $this->ejemplo->ejemplo_tipo_id = $value;
    }

    public function guardar()
    {

        $this->validate();

        try{

            DB::beginTransaction();
            $this->ejemplo->user_sid = Auth::user()->id;
            $this->ejemplo->save();

            $this->dispatchBrowserEvent('guardado');

            if (strstr($this->path, '.edit')) {
                $this->redirectRoute($this->vista);
            }

            $this->limpiarForm();
            DB::commit();

        } catch (Exception $e) {
            //dump($e);
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
            DB::rollBack();
        }
    }
}
