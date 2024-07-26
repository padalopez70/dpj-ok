<?php
namespace App\Lib;

use App\Models\GdeExpediente;
use App\Models\GdeExpedienteDoc;
use App\Models\Expediente;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class ApiGdeDB extends ApiGde
{

    public $fueraEstados = ['Guarda Temporal'];
    public $fueraTipos = ['RECI'];


    ////////////////////////////////////////////
    // consultar A DB /////////////////////////
    public static function expDB($gde, $expediente_id) //segun de donde venga seteo el id del expediente
    {

        //URLs
        $gdeCode = urlencode($gde);
        $urlExp = 'https://apigde.sde.gob.ar/api/consultas/consultarEE?nroEE='. $gdeCode;
        $urlDocs = 'https://apigde.sde.gob.ar/api/consultas/ConsultarEE_listaDocumentosOficiales_Async?nro_EE=' . $gdeCode;

        $api = new self();

        DB::beginTransaction();
        try{

            //elimino por las dudas residual de cambio de nro
            GdeExpedienteDoc::where('expediente_id', $expediente_id)->delete(); //expediente_id mi sistema "novedades"
            GdeExpediente::where('expediente_id', $expediente_id)->delete();

            //si aun existe en base lo elimino con sus documentos
            $existe = GdeExpediente::where('nro_gde', $gde)->first();
            if ($existe){
                GdeExpedienteDoc::where('nro_gde', $gde)->delete();
                $existe->delete();
            }

            //traigo los datos nuevos
            try{
                $datosExp = $api->consultar($urlExp,false,true);
            }
            catch(Exception $e){
                //si no existe en GDE lo creo con error
                $gdeExp = new GdeExpediente();
                $gdeExp->nro_gde = (string)$gde;
                $gdeExp->expediente_id = $expediente_id; //mi sistema "novedades"
                $gdeExp->estado = 'NO EXISTE EN GDE';
                $gdeExp->api_error = $e->getCode();
                $gdeExp->save();
                DB::commit();
                return; //salgo ya que no existe
            }

            //creo exp nuevo
            $gdeExp = new GdeExpediente();
            $gdeExp->nro_gde = (string)$gde;
            $gdeExp->expediente_id = $expediente_id;
            $gdeExp->estado = $datosExp['estado'];
            $gdeExp->descripcion = $datosExp['descripcion'];
            $gdeExp->reparticion_iniciadora = $datosExp['reparticion_Iniciadora'];
            $gdeExp->reparticion_actual = $datosExp['reparticion_Actual'];
            $gdeExp->fecha_creacion = Carbon::parse($datosExp['fecha_Creacion'])->format('Y-m-d H:i:s');
            $gdeExp->fecha_asociacion = Carbon::parse($datosExp['fecha_asociacion'])->format('Y-m-d H:i:s');
            $gdeExp->codigo_tramite = $datosExp['codigo_Tramite'];
            $gdeExp->usuario_iniciador = $datosExp['usuario_iniciador'];
            $gdeExp->save();

            //creo docs nuevos
            $docs = $api->consultar($urlDocs,false, true);
            $cant = count($docs);
            foreach ($docs as $key => $doc) {
                $docNuevo = new GdeExpedienteDoc();
                $docNuevo->nro_gde = (string)$gde;
                $docNuevo->orden = $cant - $key;
                $docNuevo->expediente_id = $expediente_id; //mi sistema "novedades"
                $docNuevo->fecha_creacion = Carbon::parse($doc['fecha_creacion'])->format('Y-m-d H:i:s');
                $docNuevo->nro_documento = $doc['nro_documento'];

                $partes = explode(' - ', $doc['tipo_documento']);
                $docNuevo->tipo_sigla = isset($partes[0]) ? trim($partes[0]) : null;
                $docNuevo->tipo_descripcion = isset($partes[1]) ? trim($partes[1]) : null;

                $referencia = $doc['referencia'];
                if (strpos($referencia, 'Pase electrónico') === 0) {
                    $referencia = 'Pase';
                }
                $docNuevo->referencia = $referencia;

                $docNuevo->save();


                /* LO COMENTADO SIRVE PARA RESETEAR EN EXPEDIENTE ALGUN DOCUMENTO ENCONTRADO */

                //seteo fecha del documento en el EXPEDIENTE
                $gdeExp = GdeExpediente::find($docNuevo->nro_gde); //debo volver a buscar el exp sino da error
                switch ($docNuevo->tipo_sigla) {
                    case 'F1': $gdeExp->fecha_f1 = $docNuevo->fecha_asociacion; $gdeExp->save(); break;
                    // case 'AF': $gdeExp->fecha_af = $docNuevo->fecha_creacion; $gdeExp->save(); break;
                    // case 'INFO': $gdeExp->fecha_info = $docNuevo->fecha_creacion; $gdeExp->save(); break;
                    // case 'DICTA': $gdeExp->fecha_dicta = $docNuevo->fecha_creacion; $gdeExp->save(); break;
                    // case 'RESOL': $gdeExp->fecha_resol = $docNuevo->fecha_creacion; $gdeExp->save(); break;
                    // case 'ORPAG': $gdeExp->fecha_orpag = $docNuevo->fecha_creacion; $gdeExp->save(); break;
                    // case 'ORPAR': $gdeExp->fecha_orpar = $docNuevo->fecha_creacion; $gdeExp->save(); break;
                    case 'RECI': $gdeExp->fecha_reci = $docNuevo->fecha_asociacion; $gdeExp->save(); break;

                    case 'AFCO': $gdeExp->fecha_afco = $docNuevo->fecha_asociacion; $gdeExp->save(); break;
                    case 'DISFO': $gdeExp->fecha_disfo = $docNuevo->fecha_asociacion; $gdeExp->save(); break;
                }
                $gdeExp->save();

            }
            DB::commit();
        }
        catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    //MODO EJEMPLO NO USAR
    //busco expedientes en mi base y proceso con $this->expDB
    public function Sincronizar()
    {
        $exps = Expediente::query() //depende_tabla
        ->leftJoin('gde_expedientes AS gdee', 'gdee.nro_gde', 'expedientes.gde_nro')
        ->leftJoin('gde_expediente_docs AS gded', 'gded.nro_gde', 'gdee.nro_gde')
        ->where(function($query) {

            $query->whereNotIn('gdee.estado', $this->fueraEstados) //si su estado es final no lo traigo
            //->where('gdee.created_at', '<', Carbon::now()->subHour())
            //->whereDate('gdee.created_at', '<', Carbon::today()) //si ya actualizó hoy no lo traigo

            ->whereNotExists(function ($subquery) {
                $subquery->select(DB::raw(1))
                ->from('gde_expediente_docs AS sub_gded')
                ->whereRaw('sub_gded.nro_gde = gdee.nro_gde')
                ->whereIn('sub_gded.tipo_sigla', $this->fueraTipos); //si su tipo no me interesa no lo traigo
            });
        })
        ->orWhereNull('gdee.nro_gde')
        ->select('expedientes.*') //depende_tabla
        ->distinct()
        ->orderBy('id')
        ->get();

        //busco info, si hay algun error freno 20 minutos
        foreach ($exps as $key => $exp) {
            $api = new self();
            if($exp->gde_nro != null){ //depende_tabla
                try {
                    $api->expDB($exp->gde_nro, $exp->id); //depende_tabla

                } catch (Exception $e) {
                    if(in_array($e->getCode(),['429','0','400'])){
                        return "falta";
                    }
                }
            }
        }

    }

}
