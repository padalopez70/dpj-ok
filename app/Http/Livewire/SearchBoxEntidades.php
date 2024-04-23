<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Sistema\SearchBox;
use App\Models\Entidad;
use Illuminate\Support\Facades\DB;

class SearchBoxEntidades extends SearchBox
{
    protected $listeners = ['searchBoxProductoReset'];

    public function consulta($query)
    {
        $this->datos = Entidad::select(
            'id AS id',
            DB::raw('CONCAT(denominacion, " (", legajo ,")") AS texto'),
        )
        ->whereRaw('CONCAT(denominacion," ",legajo) like ? ', array('%' . $query . '%'))
        ->orderBy('denominacion')
        ->get()
        ->map(function ($row) use ($query) {
            $query = preg_quote($query, '/'); //error en algunos casos con caracteres
            $row->textoH = preg_replace('/(' . $query . ')/i', "<b>$1</b>", $row->texto);
            return $row;
        })->toArray();
    }

    public function searchBoxProductoReset()
    {
        $this->datoSeleccionado = false;
        $this->query = '';
        $this->dato = [];
    }

    // para hacer el agregado del id del producto
    public function consultaConMin($min, $query) //pisando la de SearchBox
    {
        if(strlen($query) >= $min OR is_numeric($query)){
            $this->minError = false;
            $this->consulta($query);
        }
        else{
            $this->minError = true;
        }
    }

    public function minErrorLeyendaSet() //pisando la de SearchBox
    {
        $this->minErrorLeyenda = "Ingresar al menos  <b>".$this->min."</b> Caracteres Min O un número.";
    }

    public function mostrarDato(){ //pisando la de SearchBox
        $this->datos = Entidad::select(
            'id AS id',
            DB::raw('CONCAT(denominacion, " (", legajo ,")") AS texto'),
        )
        ->where('id',$this->mostrar)
        ->first();
        $this->datoSeleccionar(null,$this->datos['texto']);
    }
}
