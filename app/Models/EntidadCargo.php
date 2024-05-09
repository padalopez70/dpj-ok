<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntidadCargo extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'entidad_cargos';
/*
    public function tipos(){
        return $this->belongsTo(Tipo::class, 'id_tipo_entidad');
    }

    public function novedades(){
        return $this->belongsTo(Novedad::class, 'id_tipo_novedad');
    }
    */

}
