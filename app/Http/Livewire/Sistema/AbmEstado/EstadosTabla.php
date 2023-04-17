<?php

namespace App\Http\Livewire\Sistema\AbmEstado;

use App\Models\Estado;
use Exception;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class EstadosTabla extends LivewireDatatable
{
    protected $listeners = ['estadoEliminar'];

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

        return Estado::query()
      //  ->leftJoin('users AS u', 'u.id', 'noticias.user_id');
        ->orderBy('estados.id','DESC');

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

            Column::name('denominacion_estado')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Denominación'),

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
                    'edit' => 'sis.estados.edit',
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
        $this->estadoId = $id;
        $this->dispatchBrowserEvent('eliminar', [
            'objeto' => 'estado',
            'emit' => 'estadoEliminar'
        ]);
    }

    public function estadoEliminar()
    {
        try {
            $estado = Estado::findOrFail($this->estadoId);
            $estado->delete();

            $this->dispatchBrowserEvent('eliminado');
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }
    }

}
