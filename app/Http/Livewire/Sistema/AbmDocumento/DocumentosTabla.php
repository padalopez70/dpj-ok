<?php

namespace App\Http\Livewire\Sistema\AbmDocumento;

use App\Models\Documento;
use App\Models\TipoDocumento;
use Exception;
use Illuminate\Support\Facades\Storage;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DocumentosTabla extends LivewireDatatable
{
    protected $listeners = ['documentoEliminar', 'RefrescarDocumentos' =>' builder'];


    public $universo_tipos = TipoDocumento::class;
    //public $hideable = 'select';
    //public $exportable = true;
    //public $sorteable = true;

    public $filaNum;
    public $data;
    public $id_novedad;

    public $tagTipo = [
        ['value' => "INFO", 'bg' => 'bg-sky-600'],
        ['value' => "EXITO", 'bg' => 'bg-green-600'],
        ['value' => "ALARMA", 'bg' => 'bg-red-600'],
        ['value' => "GENERAL", 'bg' => 'bg-gray-600']
    ];


    public function builder()
    {
        //$this->id_novedad = request('id_novedad');
         $this->filaNum = 0;
        return Documento::query()
        ->leftJoin('tipo_documento AS u', 'u.id', 'documentos.tipo_documento')
        ->where('id_novedad', '=', $this->id_novedad)
        ->orderBy('documentos.id','DESC');

        //   ->leftJoin('tipos AS u', 'u.id', 'entidades.id_tipo_entidad')
        //->letjoin('ejemplo_tipos AS ejt','ejt.id','ejemplos.ejemplo_tipo_id');
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


         Column::name('comentario')
         ->unsortable()
         ->searchable()
         ->view('_tbl.celda-principal')
         ->label('comentario'),

         Column::name('u.denominacion_tipo_documento')
         ->unsortable()
         ->searchable()

         ->view('_tbl.celda-principal')
         ->label('tipo'),

         Column::callback(['id','path','comentario'], function ($id,$path, $comentario) {

                $link = Storage::url('docs/'.$this->id_novedad.'/'.$path);
                return view('_tbl.celda-link',['link' => $link, 'comentario'=>$comentario]);
            },[],'nombre_columna')
                ->unsortable()
                ->searchable()
                ->label('Documento vinculado'),

/*
                Column::name('u.denominacion_tipo')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Tipo Entidad'),
*/
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
                    'edit' => 'sis.documentos.index',
                    'deleteTipo' => 'tabla',
                    'delete' => true,
                    'id' => $id,
                ];
                return view('_tbl.celda-act-sin-editar', ['data' => $data]);
            })
                ->excludeFromExport()
                ->unsortable()
                ->label('Acciones'),
        ];
    }

    public function confirmarEliminacion($id)
    {
        $this->documentoId = $id;
        $this->dispatchBrowserEvent('eliminar', [
            'objeto' => 'documento',
            'emit' => 'documentoEliminar'
        ]);
    }

    public function documentoEliminar()
    {
        try {
            $documento = Documento::findOrFail($this->documentoId);
            $documento->delete();

            $this->dispatchBrowserEvent('eliminado');
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }
    }

}
