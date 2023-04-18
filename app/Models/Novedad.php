<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Novedad extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'novedades';

    public function tiposnovedad(){
        return $this->belongsTo(TipoNovedad::class, 'id_tipo_entidad');
    }

    public function Entidades(){
        return $this->hasMany(Entidad::class);
    }

}
