<!--
public $tagTipo = [
    ['value' => "INFO", 'bg' => 'bg-sky-600'],
    ['value' => "EXITO", 'bg' => 'bg-green-600'],
];

->view('_tbl.celda-tag',[ 'data' => $this->tagTipo])

-->
<div>

    @foreach ($data as $tag)
        @if ($tag['value'] == $value)
        <div class="flex items-center ">
            <div class="min-w-full h-7 pt-1 px-2 rounded-md font-bold text-center text-white {{$tag['bg']}}">{{$value}}</div>
        </div>
        @endif
    @endforeach

</div>
