<?php

namespace App\Http\Livewire\Sistema\AbmEntidad;

use App\Models\Entidad;
use App\Models\Estado;
use Exception;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class EntidadesTabla extends LivewireDatatable
{
    protected $listeners = ['entidadEliminar'];

    //public $model = Producto::class;
    //public $hideable = 'select';
    //public $exportable = true;
    //public $sorteable = true;

    public $filaNum;
    public $data;

    public $tagTipo = [
        ['value' => "INFO", 'bg' => 'bg-sky-600'],
        ['value' => "EXITO", 'bg' => 'bg-green-600'],
        ['value' => "ALARMA", 'bg' => 'bg-red-600'],
        ['value' => "GENERAL", 'bg' => 'bg-gray-600']
    ];


    public function builder()
    {
        $this->filaNum = 3;


        return Entidad::query()
            ->leftJoin('tipos AS u', 'u.id', 'entidades.id_tipo_entidad')
            ->leftJoin('estados AS e', 'e.id', 'entidades.id_estado')

        //->letjoin('ejemplo_tipos AS ejt','ejt.id','ejemplos.ejemplo_tipo_id');
        ->orderBy('entidades.id','DESC');

    }


    public function columns()
    {



        return [


/*            Column::raw('@row:=@row + 1 AS num')
                ->defaultSort('asc')
                ->label('#'),
 */

            Column::callback('id', function ($id) {
                $this->filaNum++;
                return '<b>'.$this->filaNum.'</b>';
            })
            ->unsortable()
            ->alignCenter()
            ->excludeFromExport()
            ->label('#'),

         /*
            Column::name('tipo')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-tag',[ 'data' => $this->tagTipo])
                ->label('tipo'),
         */

            Column::name('denominacion')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Nombre Entidad'),

                Column::name('u.denominacion_tipo')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Tipo Entidad'),

                Column::name('e.denominacion_estado')
                ->unsortable()
                ->searchable()

/*                 ->editable()
                 ->filterable(['activa', 'inactiva'])
 */
                  /* ->filterable($this->estados->pluck('denominacion_estado')) */
                /*  ->filterOn('e.denominacion_estado')
                ->filterable()*/
                ->view('_tbl.celda-principal')
                ->label('Estado'),


            Column::callback(['id'], function ($id) {
                $data = [
                    'showTipo' => false,
                    'show' => null,
                    'editTipo' => 'vista',
                    'edit' => 'sis.entidades.edit',
                    'mostrar_info' => 'sis.documentos.index',
                    'mostrar_info_tipo' => 'vista',
                    'deleteTipo' => 'tabla',
                    'delete' => true,
                    'id' => $id,
                ];
                return view('_tbl.celda-act', ['data' => $data]);
            })
                ->excludeFromExport()
                ->unsortable()
                ->label('Acciones'),


/*                 (new LabelColumn())
                ->label('My custom heading')
                ->content('This fixed string appears in every row'), */

        ];



    }

/*
    public function rowClasses($row, $loop)
    {
        return 'divide-x divide-gray-100 text-sm text-gray-900 ' . ($this->rowIsSelected($row) ? 'bg-yellow-100' : ($row->{'e.denominacion_estado'} === 'inactiva' ? 'bg-red-500' : ($loop->even ? 'bg-gray-100' : 'bg-gray-50')));
        dd('paso por aqui');
    }

    public function renderRow($row, $loop)
    {
        parent::renderRow($row, $loop);

        echo '<tr><td>hoooola</td></tr>';
        //$table->appendRow('<tr></tr>');

        dd('paso por aqui');
    }
 */
    public function confirmarEliminacion($id)
    {
        $this->entidadId = $id;
        $this->dispatchBrowserEvent('eliminar', [
            'objeto' => 'entidad',
            'emit' => 'entidadEliminar'
        ]);
    }

    public function entidadEliminar()
    {
        try {
            $entidad = Entidad::findOrFail($this->entidadId);
            $entidad->delete();

            $this->dispatchBrowserEvent('eliminado');
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }
    }

}
