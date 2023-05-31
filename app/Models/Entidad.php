<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entidad extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'entidades';

/*     public function tipos(){
        return $this->belongsTo(Tipo::class, 'id_tipo_entidad');
    }
 */
    public function estados(){
        return $this->belongsTo(Estado::class, 'id_estado');
    }

    public function novedades(){
        return $this->hasMany(Novedad::class, 'id');
    }

}
