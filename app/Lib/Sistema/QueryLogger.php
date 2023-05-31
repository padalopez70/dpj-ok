<?php

namespace App\Lib\Sistema;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/*** README ***/
/*
* 1) Colocar en /App/Lib/Sistema
*
* 2) Setear el modelo Log() que posee:
*    id,
*    query (text),
*    tipo (varchar 50),
*    user_id (int),
*    ip (varchar 50),
*    created_at (timestamp)
*    updated_at (timestamp)

* 3) Setear en el controlador: DB::enableQueryLog();
*
* 4) Correr por debajo de los query a MySQL : QueryLogger::do();
* si a do() no se le pasa tipo, se trata de identificar y se marcará como:
*    insert_gral, update_gral, delete_gral
*
* 5) Si en algun momento se quiere "guardar" con otro nombre algo o simplemente
* descartar un query se puede usar el DB::flushQueryLog();
*
* 6) Ejemplo completo:
*
*   DB::enableQueryLog();
*   $usuario->save();
*   $permiso1->save();
*   QueryLogger::do(insert_usuario);
*
*   $permiso2->delete();
*   DB::flushQueryLog();
*
*   $permiso3->save();
*   QueryLogger::do(insert_usuario);
*
*/
/*** README ***/
class QueryLogger
{
    public static function logQuery($query, $bindings, $type)
    {
        $bindings = array_map(function ($value) {
            if (is_string($value)) {
                return "'$value'";
            }/*  elseif ($value instanceof \DateTime) {
                return $value->format('Y-m-d H:i:s');
            } */ elseif (is_null($value)) {
                return 'NULL';
            } else {
                return $value;
            }
        }, $bindings);

        $query_with_values = vsprintf(str_replace('?', '%s', $query), $bindings);

        $log = new Log();
        $log->query = $query_with_values;
        $log->tipo = $type;
        $log->user_id = Auth::user()->id;
        $log->ip = request()->ip();
        $log->save();
    }

    public static function do($tipo = null)
    {
        $tiposql = $tipo;
        $qs = DB::getQueryLog();

        foreach ($qs as $q) {

                if($tipo == null){
                    if (str_contains($q['query'], 'select')) $tiposql = 'select_gral';
                    elseif (str_contains($q['query'], 'insert')) $tiposql = 'insert_gral';
                    elseif (str_contains($q['query'], 'update')) $tiposql = 'update_gral';
                    elseif (str_contains($q['query'], 'delete')) $tiposql = 'delete_gral';
                    QueryLogger::logQuery($q['query'], $q['bindings'], $tiposql);
                    $tiposql = null;
                }else{
                    QueryLogger::logQuery($q['query'], $q['bindings'], $tipo);
                }

        }
        //$insert_query = end($queries);
        //QueryLogger::logQuery($insert_query['query'], $insert_query['bindings'], 'insert');

    }
}
