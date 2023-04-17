<?php

namespace App\Lib\Sistema;

class Permisos
{

    public  $menu_items = [    ['text' => 'Inicio', 'url' => '/home'],
    ['text' => 'Perfil', 'url' => '/profile'],
    ['text' => 'Admin', 'url' => '/admin', 'can' => 'admin'],
];

//uso: ->middleware('PERMISOS:1,2,3');
//depende de Lib/Permisos
//depende de session permisos en FortifyService

    /**
     *  - General simplificado
     */

    public static function control($requeridos)
    {
        $pprr = explode('|', $requeridos);

        foreach ($pprr as $pr) {
            if (in_array($pr,session('permisos'))) {
                return true;
            }
        }
        return false;
    }
}
