<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noticia extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function User()
    {
        return $this->belongsTo(User::class);
        //return $this->belongTo(User::class,'id_del_usuario','id_usuario');
    }
}
