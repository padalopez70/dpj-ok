@extends('adminlte::page')  {{--esto hay que poner/sacar para  adminlte--}}


        <!-- Scripts -->
        @vite([
            'resources/css/app.css',
            'resources/css/flatpickr.css',
            'resources/js/app.js',
            'resources/js/sa2.js',
            /*   'resources/js/jquery.min.js', */
        ])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">

    <!-- banner "oficial" -->
    <x-jet-banner />


    <!-- banner esqueletor -->
    @if(request()->route()->getName() == 'inicio')<x-banner-mensaje />@endif
    @if(request()->route()->getName() == 'dashboard')<x-banner-mensaje />@endif

{{-- @config(['adminlte' => $menu_items]); --}}

{{-- @php $menu = Menu::Armar()@endphp
@php config(['adminlte.menu' => $menu]) @endphp;

@foreach (Menu::Armar() as $item)
    {{$item['text']}}<br>
@endforeach

@if(Gate::allows("crear-expediente"))
    <div class="bg-success">PUEDE crear expedientes</div>
@else
    <div class="bg-danger">NO PUEDE crear expedientes</div>
@endif --}}

{{-- {{$menu_items}}
 --}}
{{--     @if (Permisos::control(102))
    <div class="bg-success">tiene</div>
@else
    <div class="bg-danger">no tiene</div>
@endif

--}}


    @section('content')         {{--esto hay que poner/sacar para  adminlte--}}



        <div class="min-h-screen bg-gray-100">
            {{--  @livewire('navigation-menu') --}}

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>

                {{ $slot }}
            </main>
        </div>

         @stop{{--esto hay que poner/sacar para  adminlte--}}
{{--
         @stack('modals')
        @livewire('livewire-ui-modal')
        --}}
        @livewireScripts



    </body>
</html>

{{--
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

 --}}

<script>
Fancybox.bind("[data-fancybox]", {
    // Your custom options
  });

</script>
