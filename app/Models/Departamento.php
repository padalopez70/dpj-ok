<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = '_departamentos';

/*     public function entidades(){
        return $this->hasMany(Entidad::class, 'id');
    } */


}
