<!--
En Controlador:

## agregar
    use WithFileUploads;
    public $archivo;

## rules()
    'archivo' => 'max:3100|mimes:pdf'

$archivo = $this->archivo->storePublicly('public/historial');

$this->archivo_hash = pathinfo($this->archivo->hashName(), PATHINFO_FILENAME);
o con extension
$this->archivo_hash = pathinfo($this->archivo->hashName(), PATHINFO_FILENAME).".".$this->archivo->extension();

## en blade cargar slot:
   <slot>
        <x-ico2 name="arrow-up-tray"/>
        <div class="pl-1 whitespace-nowrap">Selec. Archivo</div>
    </slot>
-->


<!-- #### EJEMPLO DE VISTA CUANDO SE USA BOTON PARA SUBIR EL ARCHIVO SIN FORMULARIO-->
    {{-- <div class="w-full">
        <x-jet-label for="afip_constancia" value="Documento * (PDF,JPG, PNG. max. 2MB)" />
        <div class="flex space-x-1">
            <div class="w-full">
                <x-upload-form archivo="afip_constancia">
                    <slot>
                        <x-ico2 name="arrow-up-tray"/>
                        <div class="pl-1 whitespace-nowrap">Selec. archivo</div>
                    </slot>
                </x-upload-form>
            </div>
            <div class="my-auto">
                <x-button class="h-10">Subir</x-button>
            </div>
        </div>
        <x-jet-input-error for="afip_constancia" />
    </div> --}}


    @props([
        'archivo' => 'archivo',
        'multiple' => '',
        ])
        <div class="p-1 border rounded-md border-slate-300">
        <div>
            {{-- <x-jet-input wire:model.defer="archivo" class="block w-full" type="file" name="archivo" id="archivo" /> --}}
            <div class="flex space-x-1" x-data="{ isUploading: false, progress: 0, isUploaded: false }"
                x-on:livewire-upload-start="isUploading = true,  isUploaded = false"
                x-on:livewire-upload-finish="isUploading = false, isUploaded = true"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <div id="div-file" class="relative p-2 text-base text-white rounded-md bg-slate-900 hover:bg-slate-700">
                    <div class="flex space-x-1 text-center">
                        {{$slot}}
                        {{-- <x-ico2 name="arrow-up-tray"/> --}}
                        {{-- <div class="whitespace-nowrap">Selec. Archivo</div> --}}
                    </div>
                    <input type="file"
                    id="{{$archivo}}" wire:model="{{$archivo}}" {{$multiple}}
                    class="absolute top-0 bottom-0 left-0 right-0 w-full opacity-0 max-h max-w" />
                    {{-- style="position:absolute;top:0px;left:0px;right:0px;bottom:0px;width:100%;height:100%;opacity: 0;" --}}
                </div>
                <div class="mt-2" x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
                <div class="pt-2 text-sm font-bold text-green-800" x-show="isUploaded">
                    <x-ico2 name="check-circle" stroke="2" />
                </div>
            </div>
        </div>
        </div>
