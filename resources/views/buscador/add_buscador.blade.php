{{-- Buscador escribir nombre y seleccionar categoria by Mitzi --}}
<form method="GET" action="{{ route('posts.index') }}" class="flex flex-wrap gap-4 mb-6">
    {{-- Campo para escribir el nombre del usuario --}}
    <div>
        <label for="user_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nombre de Usuario</label>
        <input 
            type="text" 
            name="user_name" 
            id="user_name" 
            value="{{ request('user_name') }}"
            placeholder="Escribe un nombre..." 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-800 dark:text-white"
        >
    </div>

    {{-- Selector de Categoría --}}
    <div>
        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Categoría</label>
        <select 
            name="category" 
            id="category" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-800 dark:text-white"
        >
            <option value="">Selecciona una categoría</option>
            @foreach (config('category.colors') as $cat => $colors)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                    {{ $cat }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Botón de búsqueda --}}
    <div class="self-end">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Buscar</button>
    </div>
</form>
@if ($posts->count() === 0)
    <p class="text-gray-500">No se encontraron resultados con los filtros aplicados.</p>
@endif