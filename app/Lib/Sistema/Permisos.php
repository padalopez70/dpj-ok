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

/*
    public static function control($requeridos)
    {
        if(session('permisos') != null){
            $pprr = explode('|', $requeridos);
            if($pprr != 'token'){
                foreach ($pprr as $pr) {
                    if (in_array($pr,session('permisos'))) {
                        return true;
                    }
                }
                return false;
            }
        }
        return false;
    }
*/


    public static function control($requeridos)
    {

        $pprr = explode('|', $requeridos);
        $si_esta=0;
        foreach ($pprr as $pr) {
            if (in_array($pr,session('permisos'))) {
                $si_esta=1;
            }
        }
        //dd($si_esta, session('permisos')," - ",$pprr, $requeridos);

       if ($si_esta==1) return true;
        else return false;
    }


}
