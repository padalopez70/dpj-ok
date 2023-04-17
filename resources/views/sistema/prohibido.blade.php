<x-app-layout>
{{--     <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Acción No Permitida
        </h2>
    </x-slot> --}}
    <div class="py-12">
        <div class="md:max-w-5xl mx-auto px-2 md:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg w-full py-10">

                <div class="text-red-600 bg-gray-100 py-2 mb-4 shadow-md rounded-md mx-auto text-center md:w-7/12 text-xl font-bold">Ud. está intentando realizar una acción no permitida.</div>

                @if (session('prohibido_tipo') == 'permisos')
                <div class="text-left mx-auto md:w-7/12 pl-2 bg-gray-100 shadow-md rounded-md">
                    <div class="font-bold py-2 text-xl">Debe poseer los siguientes permisos:</div>
                    <div class="text-left text-lg font-bold ">
                        @foreach (session('permisos_habilita') as $key => $pr)
                            - {{$pr}}<br>
                        @endforeach
                    </div>
                </div>
                    {{-- @else
                    <script>window.location.href='{{route("inicio")}}'</script> --}}

                @endif
            </div>
        </div>
    </div>
</x-app-layout>
