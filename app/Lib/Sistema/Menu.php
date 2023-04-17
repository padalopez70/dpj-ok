<?php

namespace App\Lib\Sistema;

class Menu
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

    public static function armar()
    {
        return  [
                    ['text' => 'Inicio', 'url' => '/home'],
                    ['text' => 'Perfil', 'url' => '/profile'],
                    ['text' => 'Juan', 'url' => '/profile/juan'],
                    ['text' => 'Admin', 'url' => '/admin', 'can' => 'crear-expediente'],
                ];
    }
}
