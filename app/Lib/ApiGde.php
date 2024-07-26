<?php
namespace App\Lib;

use App\Models\Config;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;

class ApiGde
{

    /*
    7 pagado: "tipo_documento": "RECI - Recibo Firma Conjunta"
    6 orden de pago: "tipo_documento": "ORPAR - Orden de Pago"
    6 orden de pago: "tipo_documento": "ORPAG - Orden de Pago"
    5 resolucion: "tipo_documento": "RESOL - Resolución"
    4 dictamen: "tipo_documento": "DICTA - Dictamen"
    3 informe tecnico: "tipo_documento": "INFO - Informe"
    2 Afectacion: "tipo_documento": "AF - Afectacion Preventiva"
    1 formulario1 Firmado: "tipo_documento": "F1 - Formulario 1"
    */

    /*
    try {
        $gdeDocs = ApiGde::resumenDocEE($gde);
        //..

    } catch (Exception $e) {
        $this->dispatchBrowserEvent('egral',['html' => $e->getMessage()]);
    }
    */

    /*
    * PEDIR MEJORAS
    * - que traiga todos los expedientes de la reparticion y su codigo de tramite y si esta o no en guarda temporal
    * - poder buscar por documento, es decir pasar F1 y que nos traiga todos los expedientes que tienen F1
    */


    ////////////////////////////////////////////////////////
    //CONSUMIR API CON LOGIN
    ////////////////////////////////////////////////////////

    private function login()
    {

        $loginUrl = 'http://apigde.sde.gob.ar/api/cuentas/login';

        $credentials = ['Email' => env('GDE_EMAIL'), 'Password' => env('GDE_PASSWORD')];

        $client = new Client();

        try {
            $response = $client->request('POST', $loginUrl, [
                'json' => $credentials,
                'verify' => false,
            ]);

            $loginResponse = json_decode($response->getBody());
            //guardo token
            $parametro = Config::find(1);
            $parametro->token_gde = $loginResponse->token;
            $parametro->save();

        } catch (Exception $e) {
            throw new Exception("Error de Credenciales en Datacenter.", 666);
        }
    }

    ////////////////////////////////////////////
    // consultar //////////////////////////////

    public function consultar($url, $intento = false, $trueError = false)
    {

        //session()->put('token_gde', 'token_borrado');

        //leo token
        $token = DB::table('config')->first()->token_gde;

        //creo cabecera
        $client = new Client();
        $headers = [
            'Authorization' => 'bearer '.$token,
            'Accept' => '/',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Connection' => 'keep-alive',
        ];
        $options = [
            'verify' => base_path('cacert.pem'),
        ];

        //mando peticion
        $request = new Request('GET', $url, $headers);

        try {
            $response = $client->sendAsync($request, $options)->wait()->getBody();
            $responseBody = json_decode($response->__toString(), true);

            if ($responseBody['count'] == 0) {
                throw new Exception("El Expediente solicitado no existe", 404);
            }
            return $responseBody['data'];

        } catch (Exception $e) {
            // Verificar si el error es Unauthorized (401)
            // intento reconectar
            if ($e->getCode() == 401 && $intento == false) {
                $this->login();
                if($trueError){
                    return $this->consultar($url,true,true);
                }
                else{
                    return $this->consultar($url,true);
                }

            }

            // devuelvo el numero de error correcto o mensaje
            if($trueError){
                throw $e;
            }
            // error ejecute login y no funcionó
            elseif ($e->getCode() == 401 && $intento == true) {
                throw new Exception("Error de Credenciales en Datacenter.", 666);
            }
            //errores comunes
            elseif ($e->getCode() == 0) {
                throw new Exception("Superó el tiempo de ejecución. Datacenter congestionado. Intente mas tarde.", 666);
            }
            elseif ($e->getCode() == 429) {
                throw new Exception("Cupo de consultas alcanzado en el Datacenter <br>(1000 consultas C/15 minutos).", 666);
            }
            elseif ($e->getCode() == 404) {
                throw new Exception("El Expediente <b>no existe</b> en el sistema GDE.", 666);
            }
            elseif ($e->getCode() == 400) {
                throw new Exception("Error desconocido. Hablar a Informática.", 666);
            }
            else{
                throw $e;
            }
        }
    }


    //////////////////////////////////////////
    // expediente ///////////////////////////
    public static function expediente($gde)
    {
        $gdeCode = urlencode($gde);
        $url = 'https://apigde.sde.gob.ar/api/consultas/consultarEE?nroEE='. $gdeCode;

        $api = new self();
        $datos = $api->consultar($url);
        return $datos;
    }

    ////////////////////////////////////////////
    // resuemnDocEE ///////////////////////////
    public static function documentosEE($gde)
    {
        $gdeCode = urlencode($gde);
        $url = 'https://apigde.sde.gob.ar/api/consultas/ConsultarEE_listaDocumentosOficiales_Async?nro_EE=' . $gdeCode;

        $api = new self();
        $datos = $api->consultar($url);
        return $datos;
    }

    ////////////////////////////////////////////
    // resuemnDocEE ///////////////////////////
    public static function resumenDocEE($gde)
    {
        $gdeCode = urlencode($gde);
        $url = 'https://apigde.sde.gob.ar/api/consultas/ConsultarEE_listaDocumentosOficiales_Async?nro_EE=' . $gdeCode;

        $api = new self();
        $datos = $api->consultar($url);

        $docs = [];

        // si se agrega aqui nuevo tipo chequear en MdlHistorial tambien
        $mapeoAbreviaciones = [
            'F1' => 'F1',
            'AF' => 'AF',
            'AFCO' => 'AF', //afectacion termas
            'INFO' => 'IT',
            'DICTA' => 'DI',
            'RESOL' => 'RE',
            'ORPAG' => 'OP',
            'ORPAR' => 'OP',
            'RECI' => 'PA',
            'DISFO' => 'PA', //afectacion termas
        ];

        foreach ($mapeoAbreviaciones as $abreviacion) {
            $docs[$abreviacion] = false;
        }

        foreach ($datos as $doc) {
            $tipoCompleto = strtoupper(substr($doc['tipo_documento'], 0, strpos($doc['tipo_documento'], ' ')));

            // Verifica si el tipo está en el mapeo y utiliza la abreviatura correspondiente
            $tipo = isset($mapeoAbreviaciones[$tipoCompleto]) ? $mapeoAbreviaciones[$tipoCompleto] : $tipoCompleto;

            // Verifica si el tipo está en la lista permitida antes de agregarlo al array
            if (array_key_exists($tipo, $docs)) {
                $docs[$tipo] = true;
            }
        }

        return $docs;
    }


}
