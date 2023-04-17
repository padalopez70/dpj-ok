<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoNovedad extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'novedades_tipo';

    public function novedades_tipos(){
        return $this->hasMany(Novedad::class, 'id');
    }

}
