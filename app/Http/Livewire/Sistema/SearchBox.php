<?php

namespace App\Http\Livewire\Sistema;

use Livewire\Component;


class SearchBox extends Component
{
    /************************************************
     * CAMPOS SETEABLES
     * obligatorios: modelo, campos, listener
     * modificables: placeholder, sinResultado
     *
     *
     *
     *
     *  objeto:
     * ================
        <livewire:search-box id="doc_id" listener="funcionEscucha"/>

     *  listener:
     * ================
        public function paseFormAsunto($value)
        {
            $this->pase->doc_id = $value;
        }

     * parametros:
     * ================
        $this->asuntoParametros = [
            'listener' => 'paseFormAsunto',
            'placeholder' =>'',
            'sinResultado' =>''
        ];
     *************************************************/
    public $listener;
    public $min = 3;
    public $placeholder = 'Ingrese texto a buscar';
    public $sinResultado = 'Sin Resultados para la busqueda';

    public $query;
    public $datos;
    public $datoSeleccionado = false;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.sistema.search-box');
    }

    public function reseteo()
    {
        if ($this->datoSeleccionado == false) {
            $this->query = '';
            $this->datos = [];
        }
    }

    public function reseteoSeleccion()
    {
        $this->datoSeleccionado = false;
        $this->query = '';
        $this->dato = [];
        $this->emit($this->listener, null);
    }


    //cuando selecciono un resultado
    public function datoSeleccionar($indice)
    {
        //GUARDAR ID
        $this->datoSeleccionado = true;
        $this->query = $this->datos[$indice]['texto'];
        $dato = $this->datos[$indice];
        $this->emit($this->listener, $dato['id']);
        //$this->datos = [];
    }

    public function updatedQuery()
    {
        $this->datos = [];
        $this->dato = [];
        $this->minError = false;
        if ($this->query != '') {
            $this->consultaConMin($this->min, $this->query);
            $this->datoSeleccionado = false;
        }
    }

    public function consultaConMin($min, $query)
    {
        if(strlen($query) >= $min){
            $this->minError = false;
            $this->consulta($query);
        }
        else{
            $this->minError = true;
        }
    }

    public function consulta($query)
    {
        dump("Debe Crear un extends con la funcion consulta(\$query)");
        /*

        $this->datos = $this->modelo::select(
            $this->primaryKey. ' AS id',
            DB::raw($this->camposLabel . ' AS texto')
        )
        ->whereRaw($this->campos . ' like ? ', array('%' . $query . '%'))
        ->get()->toArray();
        });

        */


        // REEMPLAZAR ->get()->toArray() para marcar con:
        /*
            ->get()
            ->map(function ($row) use ($query) {
                $row->textoH = preg_replace('/(' . $query . ')/i', "<strong>$1</strong>", $row->texto);
                return $row;
            })->toArray();

        */
    }
}
