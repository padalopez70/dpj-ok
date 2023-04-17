<?php

namespace App\Http\Controllers;

use App\Models\Novedad;
use Illuminate\Routing\Controller as BaseController;

class TestController extends BaseController
{
    function __invoke()
    {
        $novedad = Novedad::where("expedientes", "001-33-01")->first();
        //$novedad = Novedad::where("expediente", "001-33-01")->first();
        dump($novedad->entidad->denominacion);
    }

}
