<?php

namespace App\Lib\Sistema;

use App\Http\Livewire\Sistema\AbmTipoNovedad\TiposNovedad as AbmTipoNovedadTiposNovedad;
use App\Models\Novedad;
use App\Models\Documento;
use App\Models\EntidadDocumento;
use App\Models\EntidadSubtipo;
use App\Models\NovedadTipo;
use App\Models\Entidad;
use Illuminate\Support\Facades\DB;


use App\Models\TipoNovedad;

/* use App\Models\BannerCerrado;
use App\Models\Noticia;
 */
class Chequeos
{

    public static function TieneDocCompleta($id) {
        return $id;

    }

    public static function VeoSiGeneranGde($registros) {
        $genera_gde=0;

/*
         $query = TipoNovedad::select('genera_gde')
        ->where('id',1 )->first();
        $novedad = $query->get();
        $sql = $query->toSql();
 */
        // Imprime la consulta SQL
//        dd($sql, $query, $novedad->genera_gde);
/*
        // Obtén la consulta SQL
        $sql = $query->toSql();

        // Imprime la consulta SQL
        dd($sql);

        // Ejecuta la consulta y obtén los resultados

 */


/*  $novedades_tipo = DB::table('novedades_tipo')
 ->select('id', 'genera_gde')
 ->where('genera_gde', '=',$registro)
 ->orderBy('id', 'asc')
 ->get();
// dd($novedades_tipo);


if($novedades_tipo ['0'] ['genera_gde'] == 1) $genera_gde=1;

 */

        foreach ($registros as $registro) {


            $fila = TipoNovedad::select('genera_gde')
            ->where('id',$registro )->first();
            //$fila = $query->get();
            if($fila->genera_gde==1) $genera_gde=1;
            //dd($registro);
            /* $query = NovedadTipo::select('genera_gde')
            ->where('id', 1)->first(); */


            //$cadena.= $registro.".<br>";

        }

return $genera_gde;

        //dd($genera_gde);
    }

    public static function TiposNovedad($id_registro, $accion) {

      $registros = NovedadTipo::select('novedad_tipos.id', 'novedades_tipo.novedad_denominacion', 'genera_gde')
    ->leftJoin('novedades_tipo', 'novedades_tipo.id', '=', 'novedad_tipos.tipo_novedad_id')
    ->where('novedad_tipos.novedad_id', $id_registro)
    ->orderBy('novedades_tipo.novedad_denominacion', 'asc')
    ->get();


/* // Obtén la consulta SQL
$sql = $query->toSql();
// Obtén los valores que serán vinculados a la consulta
$bindings = $query->getBindings();
// Imprime la consulta SQL y los valores
dd($sql, $bindings);
// Ejecuta la consulta y obtén los registros
$registros = $query->get(); */


      //dump($registros);
      //$personas = Persona::all();
      // Itera sobre los registros y los imprime
      $gde=0;
      $cadena="";
      foreach ($registros as $registro) {
          $cadena.= $registro->novedad_denominacion.".<br>";
          if($registro->genera_gde==1) $gde=1;


      }
      if($accion=="imprimir")   return $cadena;
      if($accion=="genera_gde")   return $gde;

    }



    public static function EntidadDocumentos($id_registro) {

$estatuto=0;
$personeria=0;
$asamblea=0;

        //----------cheque Estatuto
        $registro = EntidadDocumento::where('id_novedad',$id_registro)
                                        ->where('tipo_documento', 1)
                                        ->first();
        if($registro) {$cadena=' bg-success**';$estatuto=1;}
        else $cadena=' bg-danger**';

        //--------chequeo Personería Jurídica
        $registro = EntidadDocumento::where('id_novedad',$id_registro)
            ->where('tipo_documento', 2)
            ->first();
        if($registro) {$cadena.=' bg-success**';$personeria=1;}
            else $cadena.=' bg-danger**';

        //--------chequeo Asamblea;
        $registro = EntidadDocumento::where('id_novedad',$id_registro)
            ->where('tipo_documento', 3)
            ->first();
        if($registro) {$cadena.=' bg-success**';$asamblea=1;}
            else $cadena.='  bg-danger**';

            //--------------------------ACTUALIZO EN ENTIDADES EL CAMPO DOC_COMPLETO
            if($estatuto==1 && $personeria==1 && $asamblea==1)   $completa=1 ;
            else $completa=0;

            // Buscar el registro por ID
                    $entidad = Entidad::find($id_registro);

                    if (!$entidad) {
                        // Manejar el caso en el que no se encuentre el registro
                        return response()->json(['mensaje' => 'Registro no encontrado'], 404);
                    }

                    // Actualizar el campo doc_completo
                    $entidad->doc_completa = $completa;
                    $entidad->save();

        return $cadena;


    }

    public static function Actualizar_Solicitud_PJ($id_registro) {
        $novedad = Novedad::find($id_registro);

        if (!$novedad) {
            // Manejar el caso en el que no se encuentre el registro
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }

        // Actualizar el campo doc_completo
        $novedad->solicitud_pj_creada = 1;
        $novedad->save();
        return;
    }


    public static function TieneDocumentos($id_registro) {
        $registro = Documento::where('id_novedad',$id_registro)->first();

        if($registro){

            return true;
        }
        return false;

    }

    //--------------------´PREGUNTO SI EL SUBTIPO QUE QUIERO BORRAR ESTA VINCULADO a un ENTIDAD
    public static function TieneRegistrosConEsteSubtipo($id_registro) {
        $registro = EntidadSubtipo::where('subtipo_id',$id_registro)->first();

        if($registro){

            return true;
        }
        return false;

    }



    public static function TieneDocumentoTipificado($id_registro, $tipo_documento) {
        $es_tipificado=0;
        if ($tipo_documento!=4) // si el documento no es VARIOS u OTROS cheque si ya tiene uno cargadao
                {
                $registro = EntidadDocumento::where('id_novedad',$id_registro)
                                        ->where('tipo_documento', $tipo_documento)
                                        ->first();
                $es_tipificao=1;
                }

         if($registro)return true;
        else return false;

        /*
        if($tipo_documento==1)return true;
        else return false;
                */

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
