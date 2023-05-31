/*
* Instalar via :
*-------------------------------
* npm install sweetalert2

* Agregar en app.blade.php :
*------------------------------
* <script src="{{ mix('js/sa2.js') }}" defer></script>

* Agregar en vite.config.js input: []
*------------------------------
*
* .'resources/js/sa2.js',
*

*
*
* CREACION Y TIPOS PREDEFINIDOS:
*
*
*
*
* tipo: swal, eliminado, eliminado-confirmar, guardado, guardado-confirmar,
* tipo: eliminar (objeto), guardar (objeto), confirmar, informar(html), egral (errorNro, showErrorNro)
* emit: 'emit' => 'miFunc' 'emitData'=> ['dato1' => 'el dato']; function miFunc($data){ dd($data['dato1'])}
* $this->dispatchBrowserEvent('tipo', [])
*
*/


/* DATA DEFAULT */
const data_default = {
    //defaults customs
    timer_default: 1000,
    objeto_default: 'registro',

    //opciones Swal
    icon: null,  //"success", "error", "warning", "info" or "question"
    html: null,
    timer: null,
    emitData: null,
    showConfirmButton: false,
    confirmButtonText: 'Aceptar',
    showCancelButton: false,
    cancelButtonText: 'Cancelar',
    showDenyButton: false,
    denyButtonText: 'Rechazar',

    htmlPrev: false,
    htmlNext: false,
    cssBig: null,
    cssStrong: null,
    showErrorNro: null,
};

//sweetalert2
import Swal from 'sweetalert2';
window.Swal = Swal;


const SwalMix = Swal.mixin({
    customClass: {
        confirmButton: 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition',
        cancelButton: 'ml-2 inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition',
        denyButton: 'ml-2 inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition',
    },
    showClass: {
        backdrop: 'swal2-noanimation',
        popup: '',
        icon:''
    },
    hideClass: {
        popup: ''
    },
    buttonsStyling: false
  })

function swalRun(e,data){
    //console.log(data_default);

    //seteos
    if(e.detail.icon || e.detail.icon == false) data.icon = e.detail.icon;
    if(e.detail.html || e.detail.html == false) data.html = e.detail.html;
    if(e.detail.timer || e.detail.icon == data.timer) data.timer = e.detail.timer;
    if(e.detail.emitData || e.detail.emitData == false) data.emitData = e.detail.emitData;
    if(e.detail.showConfirmButton || e.detail.showConfirmButton == false) data.showConfirmButton = e.detail.showConfirmButton;
    if(e.detail.confirmButtonText || e.detail.confirmButtonText == false) data.confirmButtonText = e.detail.confirmButtonText;
    if(e.detail.showCancelButton || e.detail.showCancelButton == false) data.showCancelButton = e.detail.showCancelButton;
    if(e.detail.cancelButtonText || e.detail.cancelButtonText == false) data.cancelButtonText = e.detail.cancelButtonText;
    if(e.detail.showDenyButton || e.detail.showDenyButton == false) data.showDenyButton = e.detail.showDenyButton;
    if(e.detail.denyButtonText || e.detail.denyButtonText == false) data.denyButtonText = e.detail.denyButtonText;

    if(e.detail.cssBig || e.detail.cssBig == false) data.cssBig = e.detail.cssBig;
    if(e.detail.cssStrong || e.detail.cssStrong == false) data.cssStrong = e.detail.cssStrong;
    if(e.detail.showErrorNro || e.detail.showErrorNro == false) data.showErrorNro = e.detail.showErrorNro;

    if(e.detail.htmlPrev && e.detail.htmlPrev != false) data.htmlPrev = e.detail.htmlPrev;
    if(e.detail.htmlNext && e.detail.htmlNext != false) data.htmlNext = e.detail.htmlNext;

    if(e.detail.data && e.detail.htmlNext != false) data.htmlNext = e.detail.htmlNext;

    //agregados por fuera de las funciones
    if(data.cssBig == true) data.html='<big>'+data.html+'</big>';
    if(data.cssStrong == true) data.html='<strong>'+data.html+'</strong>';
    if(data.showErrorNro == true && e.detail.errorNro) data.html = data.html + ' (cod.'+e.detail.errorNro+')';

    //al final
    if(data.htmlPrev != false) data.html=data.htmlPrev+data.html;
    if(data.htmlNext != false) data.html=data.html+data.htmlNext;

    SwalMix.fire({
        icon: data.icon,
        html: data.html,
        timer: data.timer,
        showConfirmButton: data.showConfirmButton,
        confirmButtonText: data.confirmButtonText,
        showCancelButton: data.showCancelButton,
        cancelButtonText: data.cancelButtonText,
        showDenyButton: data.showDenyButton,
        denyButtonText: data.denyButtonText,
        }).then((result) => {
        if (result.isConfirmed) {
            if(e.detail.emit){
                Livewire.emit(e.detail.emit,data.emitData);
            }
        }
        else if(result.isDenied){
            if(e.detail.emitDeny){
                Livewire.emit(e.detail.emitDeny,data.emitData);
            }
        }
        else {
            if(e.detail.emitCancel){
                Livewire.emit(e.detail.emitCancel,data.emitData);
            }
        }
    });
}

// SWAL
window.addEventListener('default', (e) =>{
    var data = Object.assign({}, data_default);
    swalRun(e,data);
})

//eliminar
window.addEventListener('eliminar', (e) =>{
    var data = Object.assign({}, data_default);

    if(e.detail.objeto) data.objeto_default = e.detail.objeto;
    data.html = 'Confirma eliminación del '+data.objeto_default+'?';
    data.icon = 'warning';
    data.showConfirmButton = 'true';
    data.showCancelButton = 'true';
    swalRun(e, data);
})

//ActualizarDocumentosRequeridos

/* window.addEventListener('ActualizarDocumentosRequeridos', (e) =>{
    var data = Object.assign({}, data_default);

    data.html = 'Registro Eliminado';
    data.timer = data.timer_default;
    data.icon = 'success';
    data.cssStrong = data.cssBig = true;
    swalRun(e,data);
}) */


//eliminado
window.addEventListener('eliminado', (e) =>{
    var data = Object.assign({}, data_default);

    data.html = 'Registro Eliminado';
    data.timer = data.timer_default;
    data.icon = 'success';
    data.cssStrong = data.cssBig = true;
    swalRun(e,data);
})

//confirmar-eliminado
window.addEventListener('eliminado-confirmar', (e) =>{
    var data = Object.assign({}, data_default);

    data.html = 'Registro Eliminado';
    data.icon = 'success';
    data.showConfirmButton = 'true';
    data.cssStrong = data.cssBig = true;
    swalRun(e,data);
})

//guardar
window.addEventListener('guardar', (e) =>{
    var data = Object.assign({}, data_default);

    if(e.detail.objeto) data.objeto_default = e.detail.objeto;
    data.html = 'Confirma guardado de '+data.objeto_default+'?';
    data.icon = 'question';
    data.showConfirmButton = 'true';
    data.showCancelButton = 'true';
    swalRun(e,data);
})

//guardado
window.addEventListener('guardado', (e) =>{
    var data = Object.assign({}, data_default);

    data.html = 'Registro Guardado';
    data.timer = data.timer_default;
    data.icon = 'success';
    data.cssStrong = data.cssBig = true;
    swalRun(e,data);
})

//confirmar-guardado
window.addEventListener('guardado-confirmar', (e) =>{
    var data = Object.assign({}, data_default);

    data.html = 'Registro guardado';
    data.icon = 'success';
    data.showConfirmButton = 'true';
    data.cssStrong = data.cssBig = true;
    swalRun(e,data);
})


//confirmar
window.addEventListener('confirmar', (e) =>{
    var data = Object.assign({}, data_default);

    data.html = 'Confirma la acción?';
    data.icon = 'question';
    data.showConfirmButton = 'true';
    data.showCancelButton = 'true';
    swalRun(e,data);
})

//informar (se debe pasar html si o si)
window.addEventListener('informar', (e) =>{
    var data = Object.assign({}, data_default);
    data.icon = 'info';
    data.showConfirmButton = 'true';
    swalRun(e,data);
})


//error
window.addEventListener('egral', (e) =>{
    var data = Object.assign({}, data_default);

    data.icon = 'error';
    data.showConfirmButton = 'true';
    data.showErrorNro = true;
    if(e.detail.errorNro != null){
        data.html = errores(e.detail.errorNro);
    }else{
        data.html = "Ha ocurrido un error. Comuníquese con Informática.";
    }

    swalRun(e, data);
})

//errores
function errores(errorNro)
{
    console.log("entro");
    switch (errorNro) {
        case '23000':
            var html = 'No se puede eliminar. Existe registros asociados.';
            break;
        case 'HY000':
            var html = 'No se puede conectar con la Base de Datos. Intente mas tarde.';
            break;
        case '42S22':
            var html = 'Error en la Base de Datos. Comuníquese con Informática.';
            break;
        case '0':
            var html = 'Ha ocurrido un error. Comuníquese con Informática.';
        default:
            var html = 'Ha ocurrido un error. Comuníquese con Informática.';
            break;
    }
    return html;

}
