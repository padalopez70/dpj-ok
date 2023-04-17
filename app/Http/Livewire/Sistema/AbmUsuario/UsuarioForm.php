<?php

namespace App\Http\Livewire\Sistema\AbmUsuario;

use App\Mail\UsuarioPassword;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Illuminate\Support\Str;

class UsuarioForm extends Component
{

    public User $usuario;


    public function render()
    {
        return view('livewire.sistema.abm-usuario.usuario-form');
    }


    public function mount(User $usuario)
    {
        $this->usuario = $usuario;
        $this->path = Route::currentRouteName();
        strstr($this->path, '.create') ? $this->nuevo = true : $this->nuevo = false;

        $this->view = 'sis.abm-usuario.usuarios.index';
    }

    public function limpiarForm(){
        $this->usuario->name ="";
        $this->usuario->dni ="";
        $this->usuario->email ="";
        $this->usuario->password ="";
    }

    public function rules()
    {
        return [
            'usuario.name' => 'required|min:4',
            'usuario.email' => 'required|email|unique:users,email,'.$this->usuario->email,
            'usuario.dni' => 'required'
        ];
    }


    protected $messages = [
        'unique' => 'El correo electrónico ya se encuentra registrado.'
    ];

    public function updated($propertyName)
    {
        //funcion para ver en tiempo real si algo es actualizado, ej:
        //$this->validateOnly($propertyName);
    }


    public function guardar()
    {

        $this->validate();

        $clave = Str::random(8);
        $this->usuario->password = Hash::make($clave);

        try {

            $this->usuario->save();

        } catch (Exception $e) {
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }

        if(!isset($e)){

            Mail::to($this->usuario->email)->queue(new UsuarioPassword([
                'usuario' => $this->usuario,
                'clave' => $clave,
                'sistema' => config('app.name'),
                'url' => config('app.url'),
                'organismo' => 'Informática',

                ]));

            $this->dispatchBrowserEvent('guardado',['html' => 'Correo Electrónico Enviado']);
            if (strstr($this->path, '.edit')) {
                $this->redirectRoute($this->view);
            }
            $this->limpiarForm();
            $this->usuario = new User;
        }
    }

}
