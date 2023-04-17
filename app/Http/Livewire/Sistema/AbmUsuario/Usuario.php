<?php

namespace App\Http\Livewire\Sistema\AbmUsuario;

use App\Models\Permiso;
use App\Models\User;
use App\Models\UserPermiso;
use App\Models\UsersArea;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Usuario extends Component
{
    public User $usuario;
    public $area_id;
    public $estado;
    public $estado_motivo;

    public function render()
    {
        return view('livewire.sistema.abm-usuario.usuario');
    }

    public function mount(User $usuario)
    {
        $this->usuario = $usuario;

        //estado
        $this->estado = $usuario->estado;
        $this->estado_motivo = $usuario->estado_motivo;
        $this->estado_opciones = array('1' => 'HABILITADO', '0' => 'SUSPENDIDO');


        //area select opciones
        //$this->areas = Area::where('organismo_id', '4')->orderBy('nombre')->get()->toArray();

        //area select Selected
        //$this->usuario_areas = UsersArea::where('usuario_id', $this->usuario->id)->first();
        //if($this->usuario_areas) $this->area_id = $this->usuario_areas->area_id;


        //permisos
        $this->permisos();
    }

    public function permisoGuardar($permiso_id)
    {
        try {
            //si lo tiene lo borro
            $usuarioPermiso = UserPermiso::where('usuario_id', $this->usuario->id)
            ->where('permiso_id', $permiso_id)
            ->firstOrFail();
            $usuarioPermiso->delete();


        } catch (ModelNotFoundException $em) {

            //si no lo tiene lo agrego
            $usuarioPermiso = new UserPermiso();
            $usuarioPermiso->usuario_id = $this->usuario->id;
            $usuarioPermiso->permiso_id = $permiso_id;
            $usuarioPermiso->user_id = Auth::user()->id;
            $usuarioPermiso->save();

        } catch (Exception $e) {
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }

        $this->dispatchBrowserEvent('guardado');
        $this->permisos();
    }


    public function permisos()
    {
        /*
        * Debe correr si o si cada vez que se setea un permiso para que refresque bien
        */
        $this->user_permisos = UserPermiso::where('usuario_id', $this->usuario->id)->get();
        $this->permiso_tipos = Permiso::orderBy('tipo')->orderBy('nombre')->get();
        //seteo si "tiene" el permiso
        foreach ($this->user_permisos as $permiso) {
            foreach ($this->permiso_tipos as $key => $tipo) {
                if ($permiso->permiso_id == $tipo->id) {
                    $this->permiso_tipos[$key]->checked = "checked";
                }
            }
        }
    }


    // descomentar area si se necesita
    public function updatedAreaId()
    {
        try {

            $usuarioArea = UsersArea::where('usuario_id', $this->usuario->id)
                ->firstOrFail();

            $usuarioArea->area_id = $this->area_id;
            $usuarioArea->user_id = $this->usuario->id;
            $usuarioArea->user_id = Auth::user()->id;
            $usuarioArea->save();
        } catch (ModelNotFoundException $em) {

            $usuarioArea = new UsersArea;
            $usuarioArea->usuario_id = $this->usuario->id;
            $usuarioArea->area_id = $this->area_id;
            $usuarioArea->user_id = Auth::user()->id;
            $usuarioArea->save();
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('errorSQL', ['error' => $e->getCode()]);
        }

        $this->dispatchBrowserEvent('guardado');
        $this->permisos();
    }

    public function updatedEstado()
    {
        $this->usuario->estado = $this->estado;
        $this->usuario->save();
        $this->permisos();
    }

    public function guardarEstadoMotivo()
    {
        try {

            $this->usuario->estado_motivo = $this->estado_motivo;
            $this->usuario->save();

            $this->dispatchBrowserEvent('guardado');

        } catch (Exception $e) {
            $this->dispatchBrowserEvent('errorSQL', ['error' => $e->getCode()]);
        }
        $this->permisos();
    }
}
