<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'documentos';
/*
    public function tipos(){
        return $this->belongsTo(Tipo::class, 'id_tipo_entidad');
    }

    public function novedades(){
        return $this->belongsTo(Novedad::class, 'id_tipo_novedad');
    }
    */

}
