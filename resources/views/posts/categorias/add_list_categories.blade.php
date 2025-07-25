{{-- Mostrar en la lista la categoría elegida by Sitlali Michael San Martin --}}

@php
    $categoryColors = config('category.colors');
    $catColor = $categoryColors[$post->category] ?? ['bg-gray-200', 'text-gray-800', 'dark:bg-gray-700', 'dark:text-gray-200'];
@endphp

<span class="inline-block text-sm font-semibold px-3 py-1 rounded-full {{ $catColor[0] }} {{ $catColor[1] }} {{ $catColor[2] }} {{ $catColor[3] }}">
    {{ $post->category }}
</span>
