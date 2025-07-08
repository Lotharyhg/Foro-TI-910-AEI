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
                        <h2>{{ __("Your Posts!!") }}</h2>
                    </div>

                    {{-- Formulario Crear Post --}}
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <textarea name="message" placeholder="{{ __('What\'s do you think?') }}"
                            class="mt-6 block w-full rounded-md bg-white shadow-sm focus:border-indigo-200 focus:ring focus:ring-yellow-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-opacity-50 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" />
                        
                        {{-- Incluir módulo para agregar imagen by Michelle Adrian Flores Mora--}}
                         @include('posts.image.add_image') 

                        <x-primary-button class="mt-6">
                            {{ __("Posting") }}
                        </x-primary-button>
                    </form>
                </div>
            </div>

            {{-- Lista de Posts --}}
            @foreach ($posts as $post)
                <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
                    <div class="p-6 flex space-x-2">
                        <svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 0 1-3.476.383.39.39 0 0 0-.297.17l-2.755 4.133a.75.75 0 0 1-1.248 0l-2.755-4.133a.39.39 0 0 0-.297-.17 48.9 48.9 0 0 1-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97ZM6.75 8.25a.75.75 0 0 1 .75-.75h9a.75.75 0 0 1 0 1.5h-9a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H7.5Z" clip-rule="evenodd" />
                        </svg>

                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800 dark:text-gray-200 mt-5 pb-2">
                                        {{ $post->user->name }}
                                    </span>
                                    <small class="ml-2 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $post->created_at->format('d M Y g:i a') }}
                                    </small>
                                    @unless ($post->created_at->eq($post->updated_at))
                                        <small class="text-md text-gray-600 dark:text-gray-300"> &middot; {{ __('Edited') }}</small>
                                    @endunless
                                </div>
                            </div>

                            <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">
                                {{ $post->message }}
                            </p>
                             {{-- Agregar imagen a las lista de posts by Michelle Adriana Flores Mora--}}
                             @include('posts.image.add_list_image') 
                        </div>
                        @can('update', $post)
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg class = "w-9 h-7 text-gray-300 bg-gray-600 rounded-md dark:text-gray-200 dark:hover:bg-gray-500 dark:rounded-md" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                        </svg> 

                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('posts.edit', $post)">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>

                                    <div x-data="{ showConfirm: false }">
                                        <form id="delete-post-form-{{ $post->id }}" action="{{ route('posts.destroy', $post) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-dropdown-link href="#" x-on:click.stop.prevent="showConfirm = true">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>

                                        <div x-show="showConfirm" x-cloak class="fixed inset-0 flex items-center justify-center bg-black/50 p-4" x-on:click="showConfirm = false">
                                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-80">
                                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                    {{ __('Are you sure you want to delete this post?') }}
                                                </h2>
                                                <p class="text-gray-600 dark:text-gray-300 mt-2 text-sm">
                                                    {{ __('This action cannot be undone!') }}
                                                </p>
                                                <div class="mt-4 flex justify-end space-x-2">
                                                    <button x-on:click="showConfirm = false"
                                                            class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-600">
                                                        {{ __('No, Keep it!') }}
                                                    </button>
                                                    <button x-on:click="document.getElementById('delete-post-form-{{ $post->id }}').submit()"
                                                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                        {{ __('Yes, Delete it!') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </x-slot>
                            </x-dropdown>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>