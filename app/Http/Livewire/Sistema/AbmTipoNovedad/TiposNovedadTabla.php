<?php

namespace App\Http\Livewire\Sistema\AbmTipoNovedad;

use App\Models\TipoNovedad;
use Exception;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TiposNovedadTabla extends LivewireDatatable
{
    protected $listeners = ['tiponovedadEliminar'];

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
        $this->filaNum = 0;

        return TipoNovedad::query()
      //  ->leftJoin('users AS u', 'u.id', 'noticias.user_id');
        ->orderBy('novedades_tipo.id','DESC');

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

            Column::name('novedad_denominacion')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Tipo de novedad'),

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
                    'edit' => 'sis.tiposnovedad.edit',
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
        $this->tipoId = $id;
        $this->dispatchBrowserEvent('eliminar', [
            'objeto' => 'tiponovedad',
            'emit' => 'tiponovedadEliminar'
        ]);
    }

    public function tiponovedadEliminar()
    {
        try {
            $tipoNovedad = TipoNovedad::findOrFail($this->tipoId);
            $tipoNovedad->delete();

            $this->dispatchBrowserEvent('eliminado');
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }
    }

}
