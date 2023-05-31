<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;
use App\Models\Novedad;
use Illuminate\Routing\Controller as BaseController;

class TestController extends BaseController
{
    function __invoke()
    {
        Artisan::call('cache:clear');
        return 'Cache cleared successfully';
      /*
        $novedad = Novedad::where("expediente", "44-332023")->first();
        return view('livewire.sistema.abm-entidad.pruebas');
        //dump($novedad->novedad_descripcion);
        */
    }

}
