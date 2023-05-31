<?php

use App\Http\Controllers\TestController;

use App\Http\Livewire\Sistema\AbmEstado\Estados;
use App\Http\Livewire\Sistema\AbmEstado\EstadoForm;

use App\Http\Livewire\Sistema\AbmDocumento\Documentos;
use App\Http\Livewire\Sistema\AbmDocumento\DocumentoForm;

use App\Http\Livewire\Sistema\AbmNovedad\Novedades;
use App\Http\Livewire\Sistema\AbmNovedad\NovedadForm;

use App\Http\Livewire\Sistema\AbmEntidad\Entidades;
use App\Http\Livewire\Sistema\AbmEntidad\EntidadForm;

use App\Http\Livewire\Sistema\AbmEntidadDocumento\EntidadDocumentos;
use App\Http\Livewire\Sistema\AbmEntidadDocumento\EntidadDocumentoForm;

use App\Http\Livewire\Sistema\AbmTipo\Tipos;
use App\Http\Livewire\Sistema\AbmTipo\TipoForm;

use App\Http\Livewire\AbmEjemplo\EjemploForm;
use App\Http\Livewire\AbmEjemplo\Ejemplos;

//use App\Http\Livewire\Sistema\AbmDocumento\Documentos;
use App\Http\Livewire\Sistema\AbmNoticia\NoticiaForm;
use App\Http\Livewire\Sistema\AbmNoticia\Noticias;
use App\Http\Livewire\Sistema\AbmTipoNovedad\TipoNovedadForm;
use App\Http\Livewire\Sistema\AbmTipoNovedad\TiposNovedad;
use App\Http\Livewire\Sistema\AbmUsuario\Permisos;
use App\Http\Livewire\Sistema\AbmUsuario\Usuario;
use App\Http\Livewire\Sistema\AbmUsuario\UsuarioForm;
use App\Http\Livewire\Sistema\AbmUsuario\Usuarios;
use App\Http\Livewire\Sistema\Dashboard;
use App\Http\Livewire\Test\TestVarios;
use App\Models\Permiso;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
 */

 Route::get('/tt', TestController::class);
 Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Cache borrado';
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'

])->group(function () {

    //Route::get('/prueba', function() {return " hola probando";});


    Route::view('/prohibido', 'sistema.prohibido')->name('prohibido');
    Route::get('/', Dashboard::class)->name('inicio');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

     //PERMISO ADMINISTRADOR 1
     Route::group(['middleware' => ['PERMISOS:1']], function () {


        //Entidades Docuemntos
        Route::get('/entidad_documentos/crear/{id}', EntidadDocumentos::class)->name('sis.entidad.documentos.create');
        Route::get('/entidad_documentos/{id}', EntidadDocumentos::class)->name('sis.entidad.documentos.index');

        //Novedades Documentos
        Route::get('/documentos/crear/{id}', DocumentoForm::class)->name('sis.documentos.create');
        Route::get('/documentos/{id}', Documentos::class)->name('sis.documentos.index');

        //Route::get('/documentos/editar/{id}', DocumentoForm::class)->name('sis.documentos.edit');

                //Novedades
        Route::get('/novedades', Novedades::class)->name('sis.novedades.index');
        Route::get('/novedades/crear', NovedadForm::class)->name('sis.novedades.create');
        Route::get('/novedades/editar/{novedad}', NovedadForm::class)->name('sis.novedades.edit');

        //Entidades
        Route::get('/entidades', Entidades::class)->name('sis.entidades.index');
        Route::get('/entidades/crear', EntidadForm::class)->name('sis.entidades.create');
        Route::get('/entidades/editar/{entidad}', EntidadForm::class)->name('sis.entidades.edit');

        //Tipos
        Route::get('/tipos', Tipos::class)->name('sis.tipos.index');
        Route::get('/tipos/crear', TipoForm::class)->name('sis.tipos.create');
        Route::get('/tipos/editar/{tipo}', TipoForm::class)->name('sis.tipos.edit');

        //Estados
        Route::get('/estados', Estados::class)->name('sis.estados.index');
        Route::get('/estados/crear', EstadoForm::class)->name('sis.estados.create');
        Route::get('/estados/editar/{estado}', EstadoForm::class)->name('sis.estados.edit');


        //Tipos Novedad
        Route::get('/tiposnovedad', TiposNovedad::class)->name('sis.tiposnovedad.index');
        Route::get('/tiposnovedad/crear', TipoNovedadForm::class)->name('sis.tiposnovedad.create');
        Route::get('/tiposnovedad/editar/{tipoNovedad}', TipoNovedadForm::class)->name('sis.tiposnovedad.edit');


        //Usuarios
        Route::get('/sistema/usuarios', Usuarios::class)->name('sis.abm-usuario.usuarios.index');
        Route::get('/sistema/usuarios/permisos', Permisos::class)->name('sis.abm-usuario.permisos.index');
        Route::get('/sistema/usuario/crear', UsuarioForm::class)->name('sis.abm-usuario.usuario.create');
        Route::get('/sistema/usuario/editar/{usuario}', Usuario::class)->name('sis.abm-usuario.usuario.edit');
        Route::get('/sistema/usuario/{usuario}', Usuario::class)->name('sis.abm-usuario.usuario.show');
        //Route::get('/admin/usuarios/permisos', Permisos::class)->name('admin.permisos.index');

        //Noticias
        Route::get('/noticias', Noticias::class)->name('sis.noticias.index');
        Route::get('/noticias/crear', NoticiaForm::class)->name('sis.noticias.create')->middleware('PERMISOS:102');
        Route::get('/noticias/{noticia}/editar', NoticiaForm::class)->name('sis.noticias.edit');


        //Tests
        Route::get('/test/varios', TestVarios::class)->name('test.varios.index');

     });

    // GRUPO USUARIOS 2
    Route::group(['middleware' => ['PERMISOS:2']], function () {

        //ABM Ejemplo
        Route::get('/abm/ejemplo', Ejemplos::class)->name('abm-ejemplo.ejemplos.index');
        Route::get('/abm/ejemplo/crear', EjemploForm::class)->name('abm-ejemplo.ejemplo.create');
        Route::get('/abm/ejemplo/editar/{ejemplo}', EjemploForm::class)->name('abm-ejemplo.ejemplo.edit');

            //Novedades
            //Route::get('/documentos/{id}', Documentos::class)->name('sis.documentos.index');
            //Route::get('/documentos/crear/{id}', DocumentoForm::class)->name('sis.documentos.create');
           //Route::get('/documentos/editar/{id}', DocumentoForm::class)->name('sis.documentos.edit');

                    //Novedades
            Route::get('/novedades', Novedades::class)->name('sis.novedades.index');
            //Route::get('/novedades/crear', NovedadForm::class)->name('sis.novedades.create');
            //Route::get('/novedades/editar/{novedad}', NovedadForm::class)->name('sis.novedades.edit');

            //Entidades
            Route::get('/entidades', Entidades::class)->name('sis.entidades.index');
            //Route::get('/entidades/crear', EntidadForm::class)->name('sis.entidades.create');
            //Route::get('/entidades/editar/{entidad}', EntidadForm::class)->name('sis.entidades.edit');

           //emtidades documentos
           Route::get('/entidad_documentos/{id}', EntidadDocumentos::class)->name('sis.entidad.documentos.index');

            //Tipos
            Route::get('/tipos', Tipos::class)->name('sis.tipos.index');
            //Route::get('/tipos/crear', TipoForm::class)->name('sis.tipos.create');
            //Route::get('/tipos/editar/{tipo}', TipoForm::class)->name('sis.tipos.edit');




    });

});
