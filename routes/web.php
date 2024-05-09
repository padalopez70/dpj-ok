<?php

use App\Http\Controllers\TestController;

use App\Http\Livewire\Sistema\AbmEstado\Estados;
use App\Http\Livewire\Sistema\AbmEstado\EstadoForm;

use App\Http\Livewire\Sistema\AbmDocumento\Documentos;
use App\Http\Livewire\Sistema\AbmDocumento\DocumentoForm;

use App\Http\Livewire\Sistema\AbmNovedad\Novedades;
use App\Http\Livewire\Sistema\AbmNovedad\NovedadForm;
use App\Http\Livewire\Sistema\AbmNovedad\NovedadImpresion;
use App\Http\Livewire\Sistema\AbmNovedad\NovedadGde;

use App\Http\Livewire\Sistema\AbmSolicitud\Solicitudes;
use App\Http\Livewire\Sistema\AbmSolicitud\SolicitudForm;

use App\Http\Livewire\Sistema\AbmSa\SolicitudesSa;
use App\Http\Livewire\Sistema\AbmSa\SolicitudSaForm;


use App\Http\Livewire\Sistema\AbmEntidad\Entidades;
use App\Http\Livewire\Sistema\AbmEntidad\EntidadForm;

use App\Http\Livewire\Sistema\AbmEntidadDocumento\EntidadDocumentos;
use App\Http\Livewire\Sistema\AbmEntidadDocumento\EntidadDocumentoForm;

use App\Http\Livewire\Sistema\AbmEntidadCargo\EntidadCargos;
use App\Http\Livewire\Sistema\AbmEntidadCargo\EntidadCargoForm;

use App\Http\Livewire\Sistema\AbmTipo\Tipos;
use App\Http\Livewire\Sistema\AbmTipo\TipoForm;

use App\Http\Livewire\Sistema\AbmSubTipo\SubTipos;
use App\Http\Livewire\Sistema\AbmSubTipo\SubTipoForm;

use App\Http\Livewire\AbmEjemplo\EjemploForm;
use App\Http\Livewire\AbmEjemplo\Ejemplos;

//use App\Http\Livewire\Sistema\AbmDocumento\Documentos;
use App\Http\Livewire\Sistema\AbmNoticia\NoticiaForm;
use App\Http\Livewire\Sistema\AbmNoticia\Noticias;

use App\Http\Livewire\Sistema\AbmTipoNovedad\TipoNovedadForm;
use App\Http\Livewire\Sistema\AbmTipoNovedad\TiposNovedad;

use App\Http\Livewire\Sistema\AbmTipoDocumento\TipoDocumentoForm;
use App\Http\Livewire\Sistema\AbmTipoDocumento\TiposDocumento;

use App\Http\Livewire\Sistema\AbmCargo\CargoForm;
use App\Http\Livewire\Sistema\AbmCargo\Cargo;

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
     Route::group(['middleware' => ['PERMISOS:1|205']], function () {




        //Entidades Docuemntos
        Route::get('/entidad_documentos/crear/{id}', EntidadDocumentos::class)->name('sis.entidad.documentos.create');
        Route::get('/entidad_documentos/{id}', EntidadDocumentos::class)->name('sis.entidad.documentos.index');

        //Emtidades cargos
        Route::get('/entidad_cargos/{id}', EntidadCargos::class)->name('sis.entidad.cargos.index');



        //Novedades Documentos
        Route::get('/documentos/crear/{id}', DocumentoForm::class)->name('sis.documentos.create');
        Route::get('/documentos/{id}', Documentos::class)->name('sis.documentos.index');

        //Route::get('/documentos/editar/{id}', DocumentoForm::class)->name('sis.documentos.edit');

                //Novedades
        Route::get('/novedades', Novedades::class)->name('sis.novedades.index');
        Route::get('/novedades/crear', NovedadForm::class)->name('sis.novedades.create');
        Route::get('/novedades/editar/{novedad}', NovedadForm::class)->name('sis.novedades.edit');
        Route::get('/novedades/imprimir/{novedad}', NovedadImpresion::class)->name('sis.novedades.imprimir');

        //Solicitudes
        Route::get('/solicitudes', Solicitudes::class)->name('sis.solicitudes.index');
        Route::get('/solicitudes/crear/', SolicitudForm::class)->name('sis.solicitudes.create');
        Route::get('/sa', SolicitudesSa::class)->name('sis.solicitudes.sa.index');
        Route::get('/sa/crear/', SolicitudSaForm::class)->name('sis.solicitudes.sa.create');






        //Tipos
        Route::get('/tipos', Tipos::class)->name('sis.tipos.index');
        Route::get('/tipos/crear', TipoForm::class)->name('sis.tipos.create');
        Route::get('/tipos/editar/{tipo}', TipoForm::class)->name('sis.tipos.edit');

        //SubTipos
        Route::get('/subtipos', SubTipos::class)->name('sis.subtipos.index');
        Route::get('/subtipos/crear', SubTipoForm::class)->name('sis.subtipos.create');
        Route::get('/subtipos/editar/{subtipo}', SubTipoForm::class)->name('sis.subtipos.edit');


        //Estados
        Route::get('/estados', Estados::class)->name('sis.estados.index');
        Route::get('/estados/crear', EstadoForm::class)->name('sis.estados.create');
        Route::get('/estados/editar/{estado}', EstadoForm::class)->name('sis.estados.edit');


        //Tipos Novedad
        Route::get('/tiposnovedad', TiposNovedad::class)->name('sis.tiposnovedad.index');
        Route::get('/tiposnovedad/crear', TipoNovedadForm::class)->name('sis.tiposnovedad.create');
        Route::get('/tiposnovedad/editar/{tipoNovedad}', TipoNovedadForm::class)->name('sis.tiposnovedad.edit');

        //Tipos Documento
        Route::get('/tiposdocumento', TiposDocumento::class)->name('sis.tiposdocumento.index');
        Route::get('/tiposdocumento/crear', TipoDocumentoForm::class)->name('sis.tiposdocumento.create');
        Route::get('/tiposdocumento/editar/{tipoDocumento}', TipoDocumentoForm::class)->name('sis.tiposdocumento.edit');

      //Cargos
      Route::get('/cargo', Cargo::class)->name('sis.cargo.index');
      Route::get('/cargo/crear', CargoForm::class)->name('sis.cargo.create');
      Route::get('/cargo/editar/{cargo}', CargoForm::class)->name('sis.cargo.edit');

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

           //emtidades cargos
           Route::get('/entidad_cargos/{id}', EntidadCargos::class)->name('sis.entidad.cargos.index');

           //emtidades documentos
           Route::get('/entidad_documentos/{id}', EntidadDocumentos::class)->name('sis.entidad.documentos.index');



            //Tipos
            Route::get('/tipos', Tipos::class)->name('sis.tipos.index');
            //Route::get('/tipos/crear', TipoForm::class)->name('sis.tipos.create');
            //Route::get('/tipos/editar/{tipo}', TipoForm::class)->name('sis.tipos.edit');




    });


     //PERMISO MESA DE ENTRADA
    Route::group(['middleware' => ['PERMISOS:200|205']], function () {

        //Novedades
    Route::get('/novedades', Novedades::class)->name('sis.novedades.index');
    //Route::get('/novedades/crear', NovedadForm::class)->name('sis.novedades.create');
    //Route::get('/novedades/editar/{novedad}', NovedadForm::class)->name('sis.novedades.edit');
    Route::get('/novedades/imprimir/{novedad}', NovedadImpresion::class)->name('sis.novedades.imprimir');
    Route::get('/entidades', Entidades::class)->name('sis.entidades.index');
    });


    //PERMISO ADMINISTRATIVO -GDE // ADMINISTRATIVO-DOCUMENTADOR
     Route::group(['middleware' => ['PERMISOS:200|202|203|205']], function () {

        //Novedades
    Route::get('/novedades', Novedades::class)->name('sis.novedades.index');
    //Route::get('/novedades/crear', NovedadForm::class)->name('sis.novedades.create');
    //Route::get('/novedades/editar/{novedad}', NovedadForm::class)->name('sis.novedades.edit');
    Route::get('/novedades/imprimir/{novedad}', NovedadImpresion::class)->name('sis.novedades.imprimir');
    Route::get('/novedades/gde/{novedad}', NovedadGde::class)->name('sis.novedades.gde');

    //Novedades Documentos
    Route::get('/documentos/crear/{id}', DocumentoForm::class)->name('sis.documentos.create');
    Route::get('/documentos/{id}', Documentos::class)->name('sis.documentos.index');




    });

    //PERMISO ABM ENTIDADES
    Route::group(['middleware' => ['PERMISOS:1|200|204|205']], function () {

          //Entidades
          //Route::get('/entidades', Entidades::class)->name('sis.entidades.index');
          //Route::get('/entidades/crear', EntidadForm::class)->name('sis.entidades.create');
          //Route::get('/entidades/editar/{entidad}', EntidadForm::class)->name('sis.entidades.edit');
          //Entidades
        Route::get('/entidades', Entidades::class)->name('sis.entidades.index');
        Route::get('/entidades/crear/{nombre_temporal?}/{id_solicitud?}', EntidadForm::class)->name('sis.entidades.create');
        Route::get('/entidades/editar/{entidad}', EntidadForm::class)->name('sis.entidades.edit');
        Route::get('/solicitudes/editar/{novedad}', SolicitudForm::class)->name('sis.solicitudes.edit');
        Route::get('/sa/editar/{novedad}', SolicitudSaForm::class)->name('sis.solicitudes.sa.edit');

    });

    //PERMISO DIRECTOR
    Route::group(['middleware' => ['PERMISOS:205']], function () {

    //Tipos
    Route::get('/tipos', Tipos::class)->name('sis.tipos.index');
    Route::get('/tipos/crear', TipoForm::class)->name('sis.tipos.create');
    Route::get('/tipos/editar/{tipo}', TipoForm::class)->name('sis.tipos.edit');

    });



});

