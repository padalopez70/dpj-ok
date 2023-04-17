{{--
    opciones:
     - Estados::get()->pluck('nombre','id');
     - $opciones = ['1' => 'uno', '2' => 'dos'];
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
<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full block']) !!}>
    @if ($placeholderSet==true)
        <option {{$selected == null ? 'selected' : ''}} value="">{{$placeholder}}</option>
    @endif
    @foreach ($opciones as $id => $nombre)
        <option {{$selected == $id ? 'selected' : ''}} value="{{$id}}">{{$nombre}}</option>
    @endforeach
</select>
