<?php

namespace App\Http\Livewire\Sistema\AbmNovedad;

use App\Http\Livewire\Sistema\AbmTipoNovedad\TiposNovedad;
use App\Lib\Sistema\Chequeos;
use App\Models\Novedad;
use App\Models\TipoNovedad;
use Exception;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class NovedadesTabla extends LivewireDatatable
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

        // FILTRO LAS NOVEDEADES QUE SEAN DISTINTAS DE SOLICITUD DE PERSONERIA JURIDICA
        //Y DE SOCIEDADES ANONIMAS
        return Novedad::query()
            ->leftJoin('entidades AS u', 'u.id', 'novedades.id_entidad')
            ->leftJoin('novedades_tipo AS b', 'b.id', 'novedades.id_tipo_novedad')
            ->where('solicitud_pj', '=', 0)
            ->where('id_tipo_novedad', '<>', 13)
          ->orderBy('novedades.id','DESC');

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
                Column::name('u.denominacion')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Entidad'),

                Column::raw('CONCAT(numero,"-",codigo,"-",anio) AS expediente_concatenado')->unwrap()
                //Column::raw("CONCAT(ROUND(DATEDIFF(NOW(), users.dob) / planets.orbital_period, 1) AS `Native Age`")

                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Nro exp'),

                Column::callback(['id', 'u.denominacion'], function ($id) {

                    //return '<b>'.$this->filaNum.'</b>';
                    return Chequeos::TiposNovedad($id, "imprimir");

                })
                ->unsortable()
                ->alignCenter()
                ->excludeFromExport()
                ->label('Tipos de Novedad'),

                DateColumn::name('fecha')
                ->unsortable()
                ->unwrap()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label(' Fecha  '),


/*                 Column::name('b.novedad_denominacion')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Tipo Novedad'), */

                BooleanColumn::name('genera_gde')
                ->label('Genera Gde')
                ->filterable(),

                Column::name('gde')
                ->unsortable()
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('GDE'),


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
            Column::callback(['id', 'genera_gde'], function ($id,$genera_gde) {
                $data = [
                    'showTipo' => false,
                    'show' => null,
                    'editTipo' => 'vista',
                    'editNovedad' => 'sis.novedades.edit',
                    'mostrar_doc_tipo' => 'vista',
                    'mostrar_docs' => 'sis.documentos.index',
                    'imprimir_caratula_tipo' => 'vista',
                    'imprimir_caratula' => 'sis.novedades.imprimir',
                    'gde_tipo' => 'vista',
                    'gde' => 'sis.novedades.gde',

                    'deleteTipo' => 'tabla',
                    'delete' => true,
                    'id' => $id,
                    'genera_gde' => $genera_gde,
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

}
