@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-input w-full shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none font-medium']) !!}>
