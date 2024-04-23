<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoDocumento extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tipo_documento';

    public function tipo_documento(){
        return $this->hasMany(EntidadDocumento::class, 'tipo_documento');
    }

}
