<?php

namespace App\Http\Livewire\Sistema\AbmUsuario;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UsuariosTabla extends LivewireDatatable
{

    public $exportable = true;
    //public $hideable = 'inline';
    //public $model = Producto::class;
    //public $hideable = 'select';
    //public $exportable = true;
    //public $sorteable = true;


    public function builder()
    {
        return User::query();
    }


    public function columns()
    {
        return [

            NumberColumn::name('id')
                ->sortBy('id')
                ->label('ID'),

            Column::name('name')
                ->sortBy('name')
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Nombre'),

            Column::name('email')
                ->searchable()
                ->unsortable()
                ->label('Email'),

            DateColumn::name('created_at')
                ->sortBy('created_at')
                ->label('Creación'),

                DateColumn::name('updated_at')
                ->sortBy('updated_at')
                ->label('Ultima Act.'),

            Column::callback(['id'], function ($id) {
                $data = [
                    'showTipo' => false,
                    'show' => null,
                    'editTipo' => 'vista',
                    'edit' => 'sis.abm-usuario.usuario.edit',
                    'id' => $id,
                ];
                return view('_tbl.celda-act', ['data' => $data]);
            })
                ->excludeFromExport()
                ->unsortable()
                ->label('Acciones')
        ];
    }

}
