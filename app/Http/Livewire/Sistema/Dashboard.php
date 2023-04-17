<?php

namespace App\Http\Livewire\Sistema;

use App\Lib\Sistema\Mensaje;
use App\Models\Noticia;
use App\Models\UserPermiso;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = ['bannerCerrar','emitoOk','emitoKO2'];
    public $usuario;
    public $usuario_permisos;
    public $fecha;

    public function render()
    {
        //return view('livewire.sistema.dashboard');
        return view('livewire.sistema.abm-entidad.entidades');
    }

    public function mount()
    {
        //traigo usuario
        $this->usuario = Auth::user();

        //controlo si hay mensaje
        $noticia = Mensaje::check();

        if ($noticia && Mensaje::bannerEsOff($noticia->id,$this->usuario->id) == false) {
            Mensaje::bannerMostrar($noticia);
        }


        //cargo noticias
        $this->noticias = Noticia::where('noticia', '!=', NULL)
            ->select(
                'noticia',
                'id',
                'fecha',
                'user_id'
            )
            ->orderBy('fecha', 'DESC')
            ->orderBy('user_id', 'DESC')
            ->get();

        //dump($this->noticias);
        //dd($this->noticias);


        //cargo usuario y sus permisos
        $this->usuario_permisos = UserPermiso::where('usuario_id', $this->usuario->id)->get();

    }

    //cierro Banner
    public function bannerCerrar($noticia_id)
    {
        Mensaje::bannerOff($noticia_id,$this->usuario->id);
    }
}
