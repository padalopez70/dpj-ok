{{-- https://flowbite.com/docs/forms/checkbox/ --}}
@props([
    'disabled' => '',
])
<input {{$disabled}} type="checkbox" value="" {!!
    $attributes->merge(['class' => '
        w-6 h-6 mr-2
        text-sky-600
        bg-gray-100
        rounded
        border-gray-300
        focus:ring-blue-500
        dark:focus:ring-blue-600
        dark:ring-offset-gray-800
        focus:ring-2
        dark:bg-gray-700
        dark:border-gray-600
    ']) !!}>
