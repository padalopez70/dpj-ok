<?php

namespace App\Http\Livewire\Test;

use App\Http\Livewire\Sistema\SearchBox;
use App\Models\Permiso;
use Illuminate\Support\Facades\DB;

class SearchBoxTest extends SearchBox
{
    public function consulta($query)
    {
        $this->datos = Permiso::select(
            'id',
            DB::raw('CONCAT(tipo," - ",nombre) AS texto')
        )
        ->whereRaw('CONCAT(tipo," ",nombre) like ? ', array('%' . $query . '%'))
        ->orderBy('tipo')
        ->orderBy('nombre')
        ->get()
        ->map(function ($row) use ($query) {
            $row->textoH = preg_replace('/(' . $query . ')/i', "<strong>$1</strong>", $row->texto);
            return $row;
        })->toArray();

    }
}
