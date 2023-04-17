<div class="flex flex-wrap max-w-12xl px-2 gap-2">

    <div class="flex flex-col md:flex-row w-full h-12 bg-gray-200 mt-2 pb-1 px-4 rounded-lg shadow-lg">
        <div class="text-center w-full text-2xl font-bold pt-2">SISTEMA ESQUELETOR2 </div>
    </div>

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

        <!-- chivo -->
        <div class=" h-8 bg-slate-300 mt-2 mb-4 mx-4 rounded-lg shadow-lg">
            <div class="text-center w-full text-sm text-slate-400 font-bold pt-2">Desarrollado por insulae 2022</div>
        </div>
        <!-- chivo -->
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


</div>
