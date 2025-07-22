{{-- Agregar un titulo  con un label al comentario by Michelle Adriana Flores Mora --}}
<input
    placeholder="Title"
    type="text"
    name="title"
    id="title"
    value="{{ old('title', isset($post) ? $post->title : '') }}"
    class="mt-1 block w-full rounded-md bg-white shadow-sm
        focus:border-indigo-200 focus:ring focus:ring-yellow-200 focus:ring-opacity-50
        dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50
        @error('title') border-red-500 @enderror"
/>
<x-input-error :messages="$errors->get('title')" />
