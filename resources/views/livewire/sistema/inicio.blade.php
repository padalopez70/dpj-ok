<br>
<div class="bg-white text-center mt-2 pt-5 ">
<br>
<h2 class="text-center mt-5">SISTEMA DE ADMINISTRACIÓN DE PERSONAS JURIDICAS</h2>
<h4 class="text-center mt-5 text-ligth">DIRECCIÓN DE PERSONAS FÍSICAS</h4>
<h5 class="text-center mt-0 mb-5 p-2 text-dark">Fiscalía del Estado - Gobierno de Santiago del Estero</h5>
<br>

{{--
    <!-- Columna 1 -->
    <div class="flex flex-col md:w-4/12 w-full h-min gap-4">
        <div class=" bg-slate-400 rounded-lg shadow-lg">

            <div class="p-2">
                <h1 class="text-lg text-slate-700 font-bold text-center">Datos de su Usuario</h1>
            </div>

            <div class="flex-1 bg-white px-4 py-4 text-left  rounded-b-lg shadow-lg">
                <!-- objetos fuera de estructura ---->
                <div>
                    <div class="block w-full">

                        <ul>
                            <li>
                                Usuario: <label class="font-light">{{$usuario->email}}</label>
                            </li>
                            <li>
                                Nombre: <label class="font-light">{{$usuario->name}}</label>
                            </li>
                        </ul>

                        <br>
                        <hr>
                        <br>

                    </div>

                    <div class="block w-full" wire:ignore>
                        Permisos:
                        <ul>
                            @foreach ($usuario_permisos as $up)
                            <li class="font-light">-{{$up->Permiso->tipo == 'GRUPO' ? ' GRUPO: ':''}} {{$up->Permiso->nombre}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- objetos fuera de estructura ---->
            </div>

        </div>


    </div>
    <!-- Columna 1 -->



    <!-- Columna 2 -->
    <div class="flex flex-col grow md:w-7/12 space-y-4">

        <!-- fila 1 columna 2 -->
        <div class="shadow-lg rounded-lg">
            <div class="p-2 bg-slate-400 rounded-t-lg">
                <h1 class="text-lg text-slate-700 bg-slate-400 font-bold text-center">Noticias</h1>
            </div>

            <div class="flex-1 bg-white px-4 py-4 text-left  rounded-b-lg">
                <!-- objetos fuera de estructura ---->

                <div class="pt-4 px-4 h-96 overflow-y-scroll">

                    @foreach ($noticias as $noticia)

                    <div class="flex flex-col lg:flex-row border-b-2 mb-2 pb-2">
                        <div class="pr-5">
                            @php
                                $fecha = afecha($noticia->fecha);
                            @endphp

                            {{$fecha}}:
                        </div>
                        <div class="font-light">
                                {!!$noticia->noticia!!}. {{$noticia->User->name}}
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- objetos fuera de estructura ---->
            </div>
        </div>
    </div>
 --}}

</div>
