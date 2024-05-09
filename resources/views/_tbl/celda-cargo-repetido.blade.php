<span class=" " style="width: 400px;">

    {{-- @if ($nombre_cargo=="Presidente") --}}


         @if ($vigente==1)
            <div class="bg-danger p-2"> {{ $nombre_cargo }}</div>
            <?php
            //$cargo_bucle = $nombre_cargo;
            ?>
            @else
{{--             <div class="bg-secondary p-2"> {{ $nombre_cargo }} </div>
 --}}            <div class=""> {{ $nombre_cargo }} </div>

        @endif


{{--
    @else
         {{ $nombre_cargo }}
         <div class="bg-info p-2"> {{ $cargo_bucle }} </div>
    @endif
 --}}



{{-- {{$row->id}} --}}
</span>
{{--     <div class="bg-danger p-2"> {{ $value }} </div> --}}
