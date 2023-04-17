<?php

namespace App\Http\Middleware;

use App\Models\Permiso;
use Closure;
use Illuminate\Http\Request;

//uso: ->middleware('PERMISOS:1,2,3');
//depende de Lib/Permisos
//depende de session permisos en FortifyService

class Permisos
{

    public function handle(Request $request, Closure $next, $permisos_requeridos)
    {
        $permisos_requeridos = explode('|', $permisos_requeridos);
        //if($permisos_requeridos[0] != 1)dd($permisos_requeridos);

        foreach ($permisos_requeridos as $pereq) {
            if(in_array($pereq,session('permisos')))
            {
                return $next($request);
            }
            $permiso = Permiso::where('id', $pereq)->first();
            $permisos_habilita[]=$permiso->nombre;
        }

        //si no hubo coincidencia envió error
        return redirect()->route('prohibido')
            ->with('prohibido_tipo','permisos')
            ->with('permisos_habilita',$permisos_habilita);

    }
}
