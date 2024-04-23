<?php

namespace App\Http\Livewire\Sistema\AbmSa;

use App\Http\Livewire\Sistema\AbmTipoNovedad\TiposNovedad;
use App\Lib\Sistema\Chequeos;
use App\Models\Novedad;
use App\Models\TipoNovedad;
use Exception;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SolicitudesSaTabla extends LivewireDatatable
{
    protected $listeners = ['novedadEliminar', 'informar'];


    //public $model = Producto::class;
    //public $hideable = 'select';
    public $exportable = true;
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

        return Novedad::query()
            ->leftJoin('entidades AS u', 'u.id', 'novedades.id_entidad')
            ->leftJoin('novedades_tipo AS b', 'b.id', 'novedades.id_tipo_novedad')
            ->where('id_tipo_novedad', '=', 13)
          ->orderBy('novedades.id','DESC')
          ;

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
                Column::name('solicitud_nombre_entidad')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Nombre SA'),

                Column::raw('CONCAT(numero,"-",codigo,"-",anio) AS expediente_concatenado')->unwrap()
                //Column::raw("CONCAT(ROUND(DATEDIFF(NOW(), users.dob) / planets.orbital_period, 1) AS `Native Age`")

                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Nro exp'),


                DateColumn::name('fecha')
                ->unsortable()
                ->unwrap()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label(' Fecha  '),

/*                 BooleanColumn::name('solicitud_pj_aprobada')
                ->label('Aprobada')
                ->filterable(),
 */

/*                 Column::callback(['id', 'genera_gde'], function ($id) {
                    return  Chequeos::TiposNovedad($id, "genera_gde");
                })
                ->unsortable()
                ->alignCenter()
                ->excludeFromExport()
                ->filterable(['si', 'no'])
                ->label('Genera GDE'),

 */

 /*
            Column::name('novedad_descripcion')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Descripción'),

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

                //'editNovedad' => 'sis.novedades.edit',
            Column::callback(['id', 'solicitud_nombre_entidad', 'genera_gde', 'solicitud_pj_creada','solicitud_pj_aprobada'], function ($id,$solicitud_nombre_entidad,$genera_gde, $solicitud_pj_creada, $solicitud_pj_aprobada) {
                $data = [
                    'showTipo' => false,
                    'show' => null,
                    'editTipo' => 'vista',

                    'crearEntidad' => 'sis.entidades.create',
                    'editSolicitud' => 'sis.solicitudes.sa.edit',

                    'deleteTipo' => 'tabla',
                    'delete' => true,
                    'id' => $id,
                    'solicitud_nombre_entidad'=>$solicitud_nombre_entidad,
                    'genera_gde' => $genera_gde,
                    'solicitud_pj_creada' => $solicitud_pj_creada,
                    'solicitud_pj_aprobada' =>$solicitud_pj_aprobada,

                ];
                return view('_tbl.celda-solicitud-sa', ['data' => $data]);
            })
                ->excludeFromExport()
                ->unsortable()
                ->label('Acciones'),
        ];
    }


    public function confirmarEliminacion($id)
    {

        $tiene_documentos= Chequeos::TieneDocumentos($id);
       if($tiene_documentos){
        //dump('tiene');
        $this->dispatchBrowserEvent('informar', [
            'title' => 'Atención!',
            'html' => 'No se puede borrar el expediente porque tiene archivos vinculados',
            'emit' => 'CualquierCosa'
        ]);
         }
         else {
            $this->novedadId = $id;
            $this->dispatchBrowserEvent('eliminar', [
                'objeto' => 'expediente',
                'emit' => 'novedadEliminar'
            ]);
        }

    }

    public function novedadEliminar()
    {
        try {
            $novedad = Novedad::findOrFail($this->novedadId);
            $novedad->delete();

            $this->dispatchBrowserEvent('eliminado');
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }
    }

/*
    public function rowClasses($row, $loop)
    {
        return 'divide-x divide-gray-100 text-sm text-gray-900 ' . ($this->rowIsSelected($row) ? 'bg-yellow-100' : ($row->solicitud_pj_creada === '1' ? 'bg-red-500' : ($loop->even ? 'bg-gray-100' : 'bg-gray-50')));
    } */



}
