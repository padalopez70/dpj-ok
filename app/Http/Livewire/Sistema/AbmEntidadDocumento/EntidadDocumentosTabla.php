<?php

namespace App\Http\Livewire\Sistema\AbmEntidadDocumento;

use App\Models\EntidadDocumento;
use App\Lib\Sistema\QueryLogger;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class EntidadDocumentosTabla extends LivewireDatatable
{
    protected $listeners = ['documentoEliminar', 'RefrescarDocumentos' =>' builder'];


    //public $model = Producto::class;
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

        //$this->id_novedad = $id_novedad;

        $this->filaNum = 0;
         $query= EntidadDocumento::query()
        ->where('id_novedad', '=', $this->id_novedad)
        ->orderBy('entidad_documentos.id','DESC');
        //dd($query->toSql());

        return $query;

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

         Column::callback(['id','path','comentario'], function ($id,$path, $comentario) {

                $link = Storage::url('docs/'.$this->id_novedad.'/'.$path);
                return view('_tbl.celda-link',['link' => $link, 'comentario'=>$comentario]);
            },[],'nombre_columna')
                ->unsortable()
                ->searchable()
                ->label('Documento vinculado'),

         Column::callback(['tipo_documento'], function ($tipo_documento) {
                    return view('_tbl.celda-tipo-documento',['tipo_documento' => $tipo_documento]);
                },[],'nombre_columna_blabla')
                    ->unsortable()
                    ->searchable()
                    ->label('Tipo Doc'),

/*
                Column::name('u.denominacion_tipo')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Tipo Entidad'),
*/

            Column::callback(['id'], function ($id) {
                $data = [
                    'showTipo' => false,
                    'show' => null,
                    'editTipo' => 'vista',
                    'edit' => 'sis.documentos.index',
                    'mostrar_doc_tipo' => 'vista',
                    'mostrar_docs' => 'sis.entidad.documentos.index',
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
        //dd($id);
        $this->dispatchBrowserEvent('eliminar', [
            'objeto' => 'documento',
            'emit' => 'documentoEliminar'
        ]);

       // return redirect(url()->current());
    }

    public function documentoEliminar()
    {
        try {
            $documento = EntidadDocumento::findOrFail($this->documentoId);
            DB::enableQueryLog();
            $documento->delete();
            $this->emit( 'ActualizarDocumentosRequeridos', $this->id_novedad);
            $this->dispatchBrowserEvent('eliminado');
            //$this->dispatchBrowserEvent('ActualizarDocumentosRequeridos');
            QueryLogger::do('delete_entidad_documento');
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }
    }

}
