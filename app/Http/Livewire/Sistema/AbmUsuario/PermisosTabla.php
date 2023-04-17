<?php

namespace App\Http\Livewire\Sistema\AbmUsuario;

use App\Models\Permiso;
use App\Models\UserPermiso;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PermisosTabla extends LivewireDatatable
{

    //public $hideable = 'inline';
    //public $exportable = true;
    public $search;
    //public $sorteable = true;


    public function builder()
    {
        return UserPermiso::query()
        ->leftJoin('permisos AS pe', 'pe.id', 'user_permisos.permiso_id')
        ->leftJoin('users', 'users.id', 'usuario_id');
    }


    public function columns()
    {
        return [

            NumberColumn::name('id')
                ->sortBy('id')
                ->label('ID'),

            Column::name('users.name')
                ->sortBy('users.name')
                ->searchable()
                ->view('_tbl.celda-principal')
                ->label('Usuario'),

            Column::name('pe.nombre')
                ->sortBy('pe.nombre')
                ->searchable()
                ->label('Permisos'),

            DateColumn::name('created_at')
                ->sortBy('created_at')
                ->hideable()
                ->label('Creación'),
        ];
    }
}
