@props(['active' => false, 'text' => '', 'path' => null, 'thick' => 2, 'color' => ''])

@php
    $classes = $active
        ? 'group inline-flex items-center p-3 dark:border-zinc-300 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 transition duration-150 ease-in-out w-full bg-zinc-100 border rounded-lg dark:bg-zinc-600'
        : 'group inline-flex items-center p-3 dark:border-zinc-300 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 transition duration-150 ease-in-out w-full bg-white rounded-lg border-white dark:bg-zinc-900';
@endphp


<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
    <span class="mx-2 font-bold text-lg text-gray-800 dark:text-gray-100 transition-colors duration-300">
        {{ $text }}
    </span>
</a>
