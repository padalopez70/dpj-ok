{{--
    ejemplo de uso:
    <x-flatpickr wire:model="fecha" id="fecha" name="fecha"  :options="['enableTime' => 'true']" />
--}}
@props(['options' => []])

@php
    $options = array_merge([
        'dateFormat' => 'Y-m-d',
        'locale' => 'es',
        'enableTime' => false,
        'altFormat' =>  'd/m/Y',
        'max-date' => 'today()',
         'visible-months' => '3',
        //'altFormat' =>  'j F Y',
        'altInput' => true
    ], $options);
@endphp

<div wire:ignore>
    <input
        x-data="{
             value: @entangle($attributes->wire('model')),
             instance: undefined,
             init() {
                 $watch('value', value => this.instance.setDate(value, false));
                 this.instance = flatpickr(this.$refs.input, {{ json_encode((object)$options) }});
             }
        }"
        x-ref="input"
        x-bind:value="value"
        type="text"
        {{-- {{ $attributes->merge(['class' => 'form-input w-full rounded-md shadow-sm']) }} --}}
        {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full block']) !!}

    />
</div>
