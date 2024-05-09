<?php

namespace App\Http\Livewire\Sistema\AbmEntidadCargo;

use App\Models\EntidadCargo;
use App\Lib\Sistema\QueryLogger;
use Exception;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class EntidadCargosTabla extends LivewireDatatable
{
    protected $listeners = [
        'entidadCargosTablaRefresh' => '$refresh',
        'documentoEliminar', 'RefrescarDocumentos' =>' builder'
    ];


    //public $model = Producto::class;
    //public $hideable = 'select';
    //public $exportable = true;
    //public $sorteable = true;

    public $filaNum;
    public $data;
    public $id_novedad;
    public $opcion;
   public $cargo_bucle_publico;
    public $nombre_cargo;
    public $repetido="";
    public $vigente;

    public $tagTipo = [
        ['value' => "INFO", 'bg' => 'bg-sky-600'],
        ['value' => "EXITO", 'bg' => 'bg-green-600'],
        ['value' => "ALARMA", 'bg' => 'bg-red-600'],
        ['value' => "GENERAL", 'bg' => 'bg-gray-600']
    ];

/*      public function mount($id_novedad, $opcion)
    {
        $this->id_novedad = $id_novedad;
        $this->opcion = $opcion;
    }
 */
    public function builder()
    {

        //$this->id_novedad = $id_novedad;
        //$this->id_novedad = request('id');
       // $this->id_novedad = request('id');
       $this->cargo_bucle_publico="Inicial";

        $this->filaNum = 0;
        $query = EntidadCargo::query()
/*          ->select('entidad_cargos.*') // Selecciona todos los campos de entidad_cargos
         ->distinct('entidad_cargos.cargo_id') // Aplica DISTINCT al campo cargo_id
 */


        ->where('id_novedad', '=', $this->id_novedad)
        ->where('vigente', '=', 1)
       ->leftJoin('cargos AS u', 'u.id', 'entidad_cargos.cargo_id')

       ->orderBy('u.peso','ASC');
       // ->orderBy('entidad_cargos.fecha_asuncion','DESC');

        if(session('switch_soloVigentes') == false)
        {
            $query = EntidadCargo::query()
                    ->where('id_novedad', '=', $this->id_novedad)
                   ->leftJoin('cargos AS u', 'u.id', 'entidad_cargos.cargo_id')
                   ->orderBy('u.peso','ASC');



            /*
            $query = EntidadCargo::query()
            ->orderByRaw(' SELECT DISTINCT cargo_id , MIN(nombre) AS nombre
                FROM entidad_cargos WHERE id_novedad = 5080 AND entidad_cargos.deleted_at IS NULL
                GROUP BY cargo_id
                ORDER by cargo_id ASC
            ');
            */

/*
            $query = DB::select("
            SELECT DISTINCT cargo_id , MIN(cargos.nombre) AS apenom, MIN(cargos.peso) as cargo
            FROM entidad_cargos
            LEFT JOIN cargos ON cargos.id = entidad_cargos.cargo_id
            WHERE id_novedad = 5080 AND entidad_cargos.deleted_at IS NULL
            GROUP BY cargo_id ORDER by cargo_id ASC;
        "); */


/*         $query = EntidadCargo::query()
                   ->select( 'fecha_asuncion', 'entidad_cargos.nombre', 'u.peso') // Selecciona todos los campos de entidad_cargos
                  // ->distinct('entidad_cargos.cargo_id') // Aplica DISTINCT al campo cargo_id
                  ->distinct('entidad_cargos.cargo_id') // Agrega DISTINCT
                  ->where('id_novedad', '=', $this->id_novedad)
                   ->leftJoin('cargos AS u', 'u.id', 'entidad_cargos.cargo_id')
                  // ->groupBy('cargo_id')
                   ->orderBy('u.peso','DESC');
                    //->orderBy('entidad_cargos.fecha_asuncion','DESC');
 */
            //$query->where('u.peso',10);


        }

/*         ->orderByRaw('
        (SELECT peso FROM cargos WHERE id = entidad_cargos.cargo_id) ASC,
        entidad_cargos.fecha_asuncion DESC
    ');
 */


        //dd($query->toSql());

        return $query;

        //   ->leftJoin('tipos AS u', 'u.id', 'entidades.id_tipo_entidad')
        //->letjoin('ejemplo_tipos AS ejt','ejt.id','ejemplos.ejemplo_tipo_id');
    }


    //esto sirve para refrescar la tabla con algo mas
    //public function entidadCargosTablaRefresh()
    //{
    //    $c++;
    //    return true;
    //}

    public function columns()
    {

        $celdas = [

/*
            Column::raw('@row:=@row + 1 AS num')
                ->defaultSort('asc')
                ->label('#'),
*/


/*             Column::callback('id', function ($id) {
                $this->filaNum++;
                return '<b>'.$this->filaNum.'</b>';
            })
            ->unsortable()
            ->alignCenter()
            ->excludeFromExport()
            ->label('#'), */

            //Column::callback(['id','path','comentario'], function ($id,$path, $comentario) {
            Column::callback(['vigente', 'u.nombre','u.nombre'], function ($vigente, $nombre_cargo,$aux) {
                //return view('_tbl.celda-link',['link' => $link, 'comentario'=>$comentario]);
                //return '<b>'.$this->filaNum.'</b>';
                if ($nombre_cargo==$this->cargo_bucle_publico) $this->repetido="si"; else $this->repetido="no";
                $this->cargo_bucle_publico=$nombre_cargo;

                return view('_tbl.celda-cargo-repetido',['vigente' => $vigente,'nombre_cargo' => $nombre_cargo,'cargo_bucle' => $this->cargo_bucle_publico, 'repetido'=>$this->repetido]);

            })
            ->unsortable()
            ->alignCenter()
            ->excludeFromExport()
            //->group('group1')
            ->label('Cargo'),


         /*
            Column::name('tipo')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-tag',[ 'data' => $this->tagTipo])
                ->label('tipo'),
         */

         Column::name('fecha_asuncion')
         ->unsortable()
         ->searchable()
         ->view('_tbl.celda-principal')
         ->label('Fec Asun'),



         Column::name('nombre')
         ->unsortable()
         ->searchable()
         ->view('_tbl.celda-principal')
         ->label('Apellido Nombre'),

         Column::name('celular')
         ->unsortable()
         ->searchable()
         ->view('_tbl.celda-principal')
         ->label('Celular'),

         Column::name('email')
         ->unsortable()
         ->searchable()
         ->view('_tbl.celda-principal')
         ->label('email'),


/*
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
*/
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
                    'edit' => 'sis.entidad.cargos.index',
                    'mostrar_doc_tipo' => 'vista',
                    'mostrar_docs' => 'sis.entidad.cargos.index',
                    'deleteTipo' => 'tabla',
                    'delete' => true,
                    'id' => $id,

                ];
                return view('_tbl.celda-act-sin-editar', ['data' => $data]);
            },[],'acciones')
                ->excludeFromExport()
                ->unsortable()
                ->label('Acciones'),
        ];

        return $celdas;
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
            $documento = EntidadCargo::findOrFail($this->documentoId);
            DB::enableQueryLog();
            $documento->delete();
            //$this->emit( 'ActualizarDocumentosRequeridos', $this->id_novedad);
            $this->dispatchBrowserEvent('eliminado');
            //$this->dispatchBrowserEvent('ActualizarDocumentosRequeridos');
            QueryLogger::do('delete_entidad_documento');
        } catch (Exception $e) {
            //dd($e);
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }
    }

    public function actualizarSinRepetidos($idNovedad, $opcion)
    {
        $this->id_novedad = $idNovedad;
        $this->opcion = $opcion;
        dd($idNovedad,$opcion);
        $this->emit('RefrescarDocumentos'); // Emite un evento para actualizar el componente
    }


}
