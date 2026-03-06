@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium text-amber-400 bg-slate-800 transition-all duration-300'
            : 'inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-amber-400 hover:bg-slate-800 transition-all duration-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
