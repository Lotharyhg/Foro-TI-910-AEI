@php
    $categories = config('category.colors');
    $selectedCategory = old('category', $post->category ?? '');
@endphp

<label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
    {{ __('Select a Category') }}
</label>

<select id="category" name="category"
    class="mt-2 block w-full rounded-md border border-gray-300 shadow-sm
           text-sm font-medium text-center transition 
           focus:border-red-400 focus:ring focus:ring-red-300 focus:ring-opacity-50 
           dark:bg-gray-800 dark:border-gray-600 dark:focus:border-red-600 dark:focus:ring-red-400"
    onchange="updateCategoryColor(this)">
    <option value="" data-bg="" class="text-gray-700 dark:text-gray-300">
        {{ __('Choose one...') }}
    </option>

    @foreach ($categories as $cat => $colors)
        <option value="{{ $cat }}"
                data-bg="{{ implode(' ', $colors) }}"
                {{ $selectedCategory === $cat ? 'selected' : '' }}>
            {{ $cat }}
        </option>
    @endforeach
</select>

<x-input-error :messages="$errors->get('category')" />
<script>
    function updateCategoryColor(selectElement) {
        // Limpiar todas las clases previas de colores
        const bgPrefix = ['bg-', 'text-', 'dark:bg-', 'dark:text-'];
        const currentClasses = [...selectElement.classList];
        currentClasses.forEach(cls => {
            if (bgPrefix.some(prefix => cls.startsWith(prefix))) {
                selectElement.classList.remove(cls);
            }
        });

        // Obtener clases desde el option seleccionado
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const bgClasses = selectedOption.dataset.bg;

        if (bgClasses) {
            bgClasses.split(' ').forEach(cls => {
                selectElement.classList.add(cls);
            });
        }
    }

    // Ejecutar cuando la página carga si ya hay algo seleccionado
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('category');
        if (select) updateCategoryColor(select);
    });
</script>
