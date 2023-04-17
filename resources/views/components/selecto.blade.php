{{--
    opciones:
      $this->opciones = opciones::select('el_id AS id','el_nombre AS nombre')->get();
     - selected="{{$ee_id}}"
    <x-select :opciones='$opciones' :placeholderSet=false/>

--}}

@props([
    'disabled' => false,
    'placeholderSet' => true,
    'placeholder' => 'Seleccionar',
    'opciones' => [],
    'selected' => ''
])
<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'pt-1 border-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full block']) !!}>
    @if ($placeholderSet==true)
        <option value="">{{$placeholder}}</option>
    @endif
    @foreach ($opciones as $opcion)
        <option {{$selected == $opcion->id ? 'selected' : ''}} value="{{$opcion->id}}">{{$opcion->nombre}}</option>
    @endforeach
</select>
