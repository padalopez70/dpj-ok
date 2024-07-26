<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GdeExpediente extends Model
{
    use HasFactory;
    protected $primaryKey = 'nro_gde';

    public function GdeExpedienteDocs()
    {
        return $this->hasMany(GdeExpedienteDoc::class, 'nro_gde', 'nro_gde');
    }
}
