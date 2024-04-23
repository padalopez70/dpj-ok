<?php

namespace App\Http\Livewire\Sistema\AbmSubTipo;

use App\Models\SubTipo;
use App\Lib\Sistema\Chequeos;
use Exception;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SubTiposTabla extends LivewireDatatable
{
    protected $listeners = ['subtipoEliminar'];

    //public $model = Producto::class;
    //public $hideable = 'select';
    //public $exportable = true;
    //public $sorteable = true;

    public $filaNum;
    public $data;
    public $tipoId;

    public $tagTipo = [
        ['value' => "INFO", 'bg' => 'bg-sky-600'],
        ['value' => "EXITO", 'bg' => 'bg-green-600'],
        ['value' => "ALARMA", 'bg' => 'bg-red-600'],
        ['value' => "GENERAL", 'bg' => 'bg-gray-600']
    ];


    public function builder()
    {
        $this->filaNum = 0;

        return SubTipo::query()
        ->leftJoin('tipos AS u', 'u.id', 'sub_tipos.tipo_id')
        ->orderBy('sub_tipos.id','DESC');

        /* return Novedad::query()
            ->leftJoin('entidades AS u', 'u.id', 'novedades.id_entidad')
            ->leftJoin('novedades_tipo AS b', 'b.id', 'novedades.id_tipo_novedad')
          ->orderBy('novedades.id','DESC'); */




    }


    public function columns()
    {
        return [

/*
            Column::raw('@row:=@row + 1 AS num')
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

            Column::name('nombre')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Nombre del SubTipo de Entidad'),

                Column::name('u.denominacion_tipo')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Tipo de Entidad'),

                /*
            Column::name('noticia')
                ->unsortable()
                ->label('Noticia'),

            DateColumn::name('fecha')
                ->sortable()
                ->label('Fec.Noticia'),

            DateColumn::name('fecha_inicio')
                ->sortable()
                ->label('Fec.Inicio'),

            DateColumn::name('fecha_fin')
                ->sortable()
                ->label('Fec.Fin'),

            Column::name('u.name')
                ->unsortable()
                ->label('Usuario'),

                */
            Column::callback(['id'], function ($id) {
                $data = [
                    'showTipo' => false,
                    'show' => null,
                    'editTipo' => 'vista',
                    'edit' => 'sis.subtipos.edit',
                    'deleteTipo' => 'tabla',
                    'delete' => true,
                    'id' => $id,
                ];
                return view('_tbl.celda-act', ['data' => $data]);
            })
                ->excludeFromExport()
                ->unsortable()
                ->label('Acciones'),
        ];
    }

    public function confirmarEliminacion($id)
    {

        $tiene_registros= Chequeos::TieneRegistrosConEsteSubtipo($id);
       if($tiene_registros){
        //dump('tiene');
        $this->dispatchBrowserEvent('informar', [
            'title' => 'Atención!',
            'html' => 'No se puede borrar el subtipo porque tiene una Entidad vinculada',
            'emit' => 'CualquierCosa'
        ]);
         }
         else {
            $this->tipoId = $id;
            $this->dispatchBrowserEvent('eliminar', [
                'objeto' => 'subtipo',
                'emit' => 'subtipoEliminar'
            ]);
        }


 /*
        $this->tipoId = $id;
        $this->dispatchBrowserEvent('eliminar', [
            'objeto' => 'subtipo',
            'emit' => 'subtipoEliminar'
        ]);
 */
    }

    public function subtipoEliminar()
    {
        try {
            $tipo = SubTipo::findOrFail($this->tipoId);
            $tipo->delete();

            $this->dispatchBrowserEvent('eliminado');
        } catch (Exception $e) {
            dump($e);
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }
    }

}
