<?php

namespace App\Http\Livewire\AbmEjemplo;

use App\Models\Ejemplo;
use Exception;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class EjemplosTabla extends LivewireDatatable
{
    protected $listeners = ['ejemploEliminar'];

    public $exportable = true;
    //public $hideable = 'inline';
    //public $model = Producto::class;
    //public $hideable = 'select';
    //public $exportable = true;
    //public $sorteable = true;


    public function builder()
    {
        return Ejemplo::query()
            ->join('ejemplo_tipos AS ejt','ejt.id','ejemplos.ejemplo_tipo_id');
    }


    public function columns()
    {
        return [

            NumberColumn::name('id')
                ->sortBy('id')
                ->label('ID'),

            Column::name('nombre')
                ->sortBy('name')
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Nombre'),

            Column::name('ejt.nombre')
                ->searchable()
                ->label('Ejemplo Tipo'),

            DateColumn::name('created_at')
                ->sortBy('created_at')
                ->sortable()
                ->label('Creación'),


            Column::callback(['id'], function ($id) {
                $data = [
                    'showTipo' => false,
                    'show' => null,
                    'editTipo' => 'vista',
                    'edit' => 'abm-ejemplo.ejemplo.edit',
                    'deleteTipo' => 'tabla',
                    'delete' => true,

                    'id' => $id,
                ];
                return view('_tbl.celda-act', ['data' => $data]);
            })
                ->excludeFromExport()
                ->unsortable()
                ->label('Acciones')
        ];
    }

    public function confirmarEliminacion($id)
    {
        $this->objId = $id;
        $this->dispatchBrowserEvent('eliminar', [
            'objeto' => 'Ejemplo',
            'emit' => 'ejemploEliminar'
        ]);
    }

    public function ejemploEliminar()
    {
        try {
            $obj = Ejemplo::findOrFail($this->objId);
            $obj->delete();

            $this->dispatchBrowserEvent('eliminado');
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('egral', ['errorNro' => $e->getCode()]);
        }
    }

}
