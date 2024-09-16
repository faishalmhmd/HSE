@props(['active' => false, 'text' => '', 'path' => null, 'thick' => 2, 'color' => ''])

@php
    $classes = $active
        ? 'group inline-flex items-center p-3 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 transition duration-150 ease-in-out w-full hover:bg-blue-600 rounded-lg hover:text-black bg-blue-500'
        : 'group inline-flex items-center p-3 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 transition duration-150 ease-in-out w-full hover:bg-gray-200 rounded-lg hover:text-black';
@endphp


<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
    <span
        class="mx-2 font-bold text-xl text-black dark:text-gray-100 transition-colors duration-300 group-hover:text-black">
        {{ $text }}
    </span>
</a>
