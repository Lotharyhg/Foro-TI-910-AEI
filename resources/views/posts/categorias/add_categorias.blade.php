{{-- <h4>AQUÍ TIENES QUE PONER TODO TU CÓDIGO PARA AGREGAR TUS CATEGORÍAS, UN DESPLEGABLE DE 6 CATEGORÍAS --}}

<label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
    {{ __('Select a Category') }}
</label>

@php
    $categories = config('category.colors');
    $selectedCategory = old('category', $post->category ?? '');
@endphp

<div class="mt-2 flex flex-wrap gap-2">
    @foreach ($categories as $cat => $colors)
        <label class="cursor-pointer">
            <input type="radio" name="category" value="{{ $cat }}" class="hidden peer"
                {{ $selectedCategory === $cat ? 'checked' : '' }}>

            <div class="px-4 py-2 rounded-full transition text-sm font-medium 
                peer-checked:bg-black peer-checked:text-white
                {{ $colors[0] }} {{ $colors[1] }} {{ $colors[2] }} {{ $colors[3] }}">
                {{ $cat }}
            </div>
        </label>
    @endforeach
</div>

<x-input-error :messages="$errors->get('category')" />
