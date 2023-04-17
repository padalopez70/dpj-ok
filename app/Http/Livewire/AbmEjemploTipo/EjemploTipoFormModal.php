<?php

namespace App\Http\Livewire\AbmEjemploTipo;

use App\Models\EjemploTipo;
use LivewireUI\Modal\ModalComponent;
use Exception;
use Illuminate\Support\Facades\Auth;

class EjemploTipoFormModal extends ModalComponent
{
    public EjemploTipo $ejemplo_tipo;

    public function render()
    {
        return view('livewire.abm-ejemplo-tipo.ejemplo-tipo-form-modal');
    }

    public function mount(EjemploTipo $ejemplo_tipo, $data)
    {
        $this->data = $data;

        if($data['form'] == 'edit'){
            $this->ejemplo_tipo = EjemploTipo::where('id',$data['id'])->firstOrFail();
        }
        elseif($data['form'] == 'create'){
            $this->ejemplo_tipo = new EjemploTipo();
        }

    }

    public function rules()
    {
        return [
            'ejemplo_tipo.nombre' => 'required|unique:ejemplo_tipos,nombre,' . $this->ejemplo_tipo->nombre,
        ];
    }


    protected $messages = [
        'unique' => 'Ya se encuentra creado.'
    ];

    protected $validationAttributes = [
        //'ejemplo_tipo.nombre' => 'Nombre',
    ];

    public function guardar()
    {
        $this->validate();

        try {

            $this->ejemplo_tipo->user_id = Auth::user()->id;
            $this->ejemplo_tipo->save();
            $this->closeModal();
            $this->dispatchBrowserEvent('guardado');

            if($this->data['ejemploFormUpdate'] == TRUE)
            {
                // "externo" le digo a ejemploForm que actualice
                $this->emit('ejemploFormUpdate', $this->ejemplo_tipo->id);
            }
            else{
                // desde "ABM" le digo a la tabla de ejemplos tipos que actualice
                $this->emit('ejemploTipoTablaRefresh');
            }


        } catch (Exception $e) {
                $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }
    }
}
