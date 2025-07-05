<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-sm text-gray-800 dark:text-orange-300 leading-tight">
            {{ __('Postings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="w-full text-center text-xl dark:text-white">
                        <h2>{{ __("Edit your Post") }}</h2>
                    </div>

                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf

                        <textarea name="message" placeholder="{{ __('What\'s do you think?') }}"
                            class="mt-6 block w-full rounded-md bg-white shadow-sm focus:border-indigo-200 focus:ring focus:ring-yellow-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-opacity-50 @error('message') border-red-500 @enderror">{{ old('message', $post->message) }}</textarea>

                        <x-input-error :messages="$errors->get('message')" />

                        {{-- Agregar imagen al Post --}}
                        @if ($post->image)
                            <div class="mt-4">  
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="rounded-lg max-h-80 mx-auto">
                                <div class="mt-2">
                                {{-- Remueve la imagen --}}
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="remove_image" value="1" class="rounded text-red-600">
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ __('Remove current image') }}</span>
                                    </label>
                                </div>
                            </div>
                        @endif
                        {{-- Mostrar Imagen si existe --}}
                        <input type="file" name="image" class="mt-4 text-sm text-gray-700 dark:text-gray-200">
                        {{-- Mostrar errores de imagen --}}
                        <x-input-error :messages="$errors->get('image')" />

                        <x-primary-button class="mt-6">
                            {{ __("Save Changes") }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
