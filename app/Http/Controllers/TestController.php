<?php

namespace App\Http\Controllers;

use App\Models\Novedad;
use Illuminate\Routing\Controller as BaseController;

class TestController extends BaseController
{
    function __invoke()
    {
        $novedad = Novedad::where("expediente", "44-332023")->first();
        return view('livewire.sistema.abm-entidad.pruebas');
        //dump($novedad->novedad_descripcion);
    }

}
