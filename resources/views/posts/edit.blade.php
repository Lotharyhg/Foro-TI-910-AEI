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
                        
                        <!-- Módulos condicionales de la imagen by Michelle Adriana Flores Mora  -->
                            @if($post->image)
                                @include('posts.image.update_add_image')
                            @else
                                @include('posts.image.add_image')
                            @endif           
                                         
                        <x-primary-button class="mt-6">
                            {{ __("Save Changes") }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>