<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$nuevo == true ? 'Crear ' : 'Editar'}} Usuario
        </h2>
    </x-slot>


    <div>
        <div class="max-w-7xl mx-auto mt-4 py-10 sm:px-6 lg:px-8 shadow-md rounded-md">
            <x-form-section submit="guardar" autocomplete="off">
                <x-slot name="title"><strong>Atención</strong></x-slot>
                <x-slot name="description">
                    <div>
                        Controle que el Correo Electrónico ingresado sea el correcto,
                        ya que este será el usuario para ingresar al sistema y a donde
                        se enviará la contraseña.
                    </div>
                </x-slot>
                <x-slot name="form">
                    <div class="col-span-12 relative">
                        <a href="{{route($view)}}">
                            <x-ico2s name="backward" class="h-10 w-10 absolute right-0 fill-sky-300" />
                        </a>
                    </div>

                    <div class="col-span-12">
                        <x-jet-label for="nombre" value="Nombre y Apellido *" />
                        <x-jet-input wire:model.defer='usuario.name' type="text" id="nombre" class="w-full block" />
                        <x-jet-input-error for="usuario.name" />
                    </div>

                    <div class="col-span-12">
                        <x-jet-label for="dni" value="DNI *" />
                        <x-jet-input wire:model.defer='usuario.dni' type="text" id="dni" class="w-full block" />
                        <x-jet-input-error for="usuario.dni" />
                    </div>

                    <div class="col-span-12">
                        <x-jet-label for="email" value="Correo Electrónico" />
                        <x-jet-input wire:model.defer='usuario.email' type="email" id="email" class="w-full block" />
                        <x-jet-input-error for="usuario.email" />
                    </div>

                    <div class="col-span-12">
                        <x-slot name="actions">
                            <div class="space-x-2">
                                @if($nuevo == true)
                                    <x-button2 wire:click="limpiarForm">Limpiar</x-jet-secondary-button></a>
                                @endif
                                <x-button>Guardar</x-jet-button>
                            </div>
                        </x-slot>
                    </div>
                </x-slot>
            </x-form-section>
        </div>
    </div>
</div>
