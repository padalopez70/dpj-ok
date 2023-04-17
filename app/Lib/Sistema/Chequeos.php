<?php

namespace App\Lib\Sistema;
use App\Models\Documento;

/* use App\Models\BannerCerrado;
use App\Models\Noticia;
 */
class Chequeos
{


    public static function TieneDocumentos($id_registro) {
        $registro = Documento::where('id_novedad',$id_registro)->first();

        if($registro){

            return true;
        }
        return false;

    }

    /**
     * - Envia un mensaje a flash.banner de Jetstream
     * - style: success (default) o danger
     */
    public static function jet(string $message, string $style = 'success')
    {
        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', $style);
    }

    public static function bannerMostrar(object $mensaje)
    {
        session()->flash('flash.mensaje', $mensaje->titulo);
        session()->flash('flash.mensajeTipo', $mensaje->tipo);
        session()->flash('flash.mensajeId', $mensaje->id);
    }

    public static function bannerOff($id,$user_id)
    {
        $off = new BannerCerrado;
        $off->noticia_id = $id;
        $off->user_id = $user_id;
        $off->save();
    }

    public static function bannerEsOff($noticia_id,$user_id)
    {
        $cerrado = bannerCerrado::where('noticia_id',$noticia_id)
            ->where('user_id', $user_id)->first();

        if($cerrado){
            return true;
        }
        return false;
    }

    public static function check()
    {
        $noticia = Noticia::where('fecha_fin','>=',now())
        ->orderBy('fecha_fin','DESC')
        ->orderBy('id','DESC')
        ->first();

        return $noticia;
    }
}
