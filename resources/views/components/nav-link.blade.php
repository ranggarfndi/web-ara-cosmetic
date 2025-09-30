@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'group flex items-center px-2 py-2 text-sm font-medium rounded-md text-white bg-primary-700 dark:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-white'
            : 'group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white';
    $iconClasses =
        $active ?? false
            ? 'mr-3 h-6 w-6 flex-shrink-0 text-white'
            : 'mr-3 h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <div class="{{ $iconClasses }}">
        {{ $icon }}
    </div>
    {{ $slot }}
</a>
