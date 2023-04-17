<?php

namespace App\Http\Livewire\Test;

use Livewire\Component;

class TestVarios extends Component
{
    protected $listeners = ['sa2ConfirmarAccion', 'searchBoxTestEscucha'];
    public $searchBoxResultado;

    public function render()
    {
        return view('livewire.test.test-varios');
    }

    //default
    public function sa2Default()
    {
        $this->dispatchBrowserEvent('default',[
            'html' => 'Este es el cuerpo de la alerta<br><strong>va con tags HTML</strong>',
            'showConfirmButton' => 'true',
            'ConfirmButtonText' => 'Aceptar',
            'icon' => 'success'

        ]);
    }

    //confirmar
    public function sa2Confirmar()
    {
        $this->dispatchBrowserEvent('confirmar',[
            'html' => 'desea confirmar?',
            'cancelButtonText' => 'Borrar',
            'emit' => 'sa2ConfirmarAccion',
            'emitCancel' => 'borrarCancel'
        ]);
    }

    public function sa2ConfirmarAccion()
    {
        $this->dispatchBrowserEvent('guardado');
    }

    //error gral
    public function sa2Egral()
    {
        $this->dispatchBrowserEvent('egral',[
            'errorNro' => '1', //null no muestra, sino 'showErrorNro' => false
            'showErrorNro' => false,
            'html' => 'Ha Ocurrido un error'
        ]);
    }

    public function searchBoxTestEscucha($value){
        $this->searchBoxResultado = $value;
    }
}
