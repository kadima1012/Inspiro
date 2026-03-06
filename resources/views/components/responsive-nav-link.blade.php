@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 rounded-lg text-start text-base font-medium text-amber-400 bg-slate-800 transition-all duration-300'
            : 'block w-full ps-3 pe-4 py-2 rounded-lg text-start text-base font-medium text-gray-300 hover:text-amber-400 hover:bg-slate-800 transition-all duration-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
