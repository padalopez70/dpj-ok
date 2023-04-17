<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermiso extends Model
{
    use HasFactory;

    public function Permiso()
    {
        return $this->belongsTo(Permiso::class);
    }
}
