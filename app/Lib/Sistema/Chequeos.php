<?php

namespace App\Lib\Sistema;
use App\Models\Documento;
use App\Models\EntidadDocumento;


/* use App\Models\BannerCerrado;
use App\Models\Noticia;
 */
class Chequeos
{

    public static function EntidadDocumentos($id_registro) {
        //----------cheque Estatuto
        $registro = EntidadDocumento::where('id_novedad',$id_registro)
                                        ->where('tipo_documento', 1)
                                        ->first();
        if($registro) $cadena=' bg-success**';
        else $cadena=' bg-danger**';

        //--------chequeo Personería Jurídica
        $registro = EntidadDocumento::where('id_novedad',$id_registro)
            ->where('tipo_documento', 2)
            ->first();
        if($registro) $cadena.=' bg-success**';
            else $cadena.=' bg-danger**';

        //--------chequeo Personería Jurídica
        $registro = EntidadDocumento::where('id_novedad',$id_registro)
            ->where('tipo_documento', 3)
            ->first();
        if($registro) $cadena.=' bg-success**';
            else $cadena.='  bg-danger**';

        return $cadena;


    }


    public static function TieneDocumentos($id_registro) {
        $registro = Documento::where('id_novedad',$id_registro)->first();

        if($registro){

            return true;
        }
        return false;

    }

    public static function TieneDocumentoTipificado($id_registro, $tipo_documento) {
        if ($tipo_documento!=4) // si el documento no es VARIOS u OTROS cheque si ya tiene uno cargadao
        $registro = EntidadDocumento::where('id_novedad',$id_registro)
                                        ->where('tipo_documento', $tipo_documento)
                                        ->first();

        if($registro)return true;
        else return false;

    }

    public static function DisplayDocTip( $tipo_documento) {
        if ($tipo_documento==1) return 'Estatuto';
        elseif ($tipo_documento==2) return 'Resolución de Personería Jurídica';
        elseif ($tipo_documento==3) return 'Ultima acta de Asamblea';

        $registro = EntidadDocumento::where('id_novedad',$id_registro)
                                        ->where('tipo_documento', $tipo_documento)
                                        ->first();

        if($registro)return true;
        else return false;

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
