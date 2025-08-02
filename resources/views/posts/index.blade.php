<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-sm text-gray-800 dark:text-orange-300 leading-tight">
            {{ __('Postings') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          {{-- Cambiar color del div by Michelle Adrian Flores Mora--}}
            <div class="bg-white dark:bg-sky-950 overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="w-full text-center text-xl dark:text-white">
                        <h2>{{ __("Your Posts!!") }}</h2>
                    </div>

                    {{-- Formulario Crear Post --}}
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                            {{-- Añadir un titulo al comentario by Michelle Adriana Flores Mora --}}
                        @include('posts.image.title.add_title') 

                        <textarea name="message" placeholder="{{ __('What\'s do you think?') }}"
                            class="mt-6 block w-full rounded-md bg-white shadow-sm focus:border-indigo-200 focus:ring focus:ring-yellow-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" />
                        
                        {{-- Incluir módulo para agregar imagen by Michelle Adrian Flores Mora--}}
                        @include('posts.image.add_image') 

                         {{-- Incluir módulo para agregar categorias by Sitlali San Martin Juarez--}}
                        @include('posts.categorias.add_categorias') 

                        <x-primary-button class="mt-6">
                            {{ __("Posting") }}
                        </x-primary-button>
                        
                   


                    </form>
                </div>
            </div>
            <br>
         {{-- Módulo de agregar el buscador by Mitzi --}}
@include('buscador.add_buscador')

            {{-- Lista de Posts --}}
            @foreach ($posts as $post)
                <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
                    <div class="p-6 flex space-x-2">
                         {{-- Imagen de perfil en comentario --}}
                            <img src="{{ Auth::user()->profile_photo_url }}" class="w-8 h-8 rounded-full object-cover">

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
                                                    
                             {{-- Mostrar el titulo en los comentarios by Michelle Adriana Flores Mora --}}
                            @include('posts.image.title.add_title_list')

                            <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">
                                {{ $post->message }}
                            </p>

                            {{-- Agregar imagen a las lista de posts by Michelle Adriana Flores Mora--}}
                            @include('posts.image.add_list_image')
                            {{-- Agregar la categpria a la lista de posts by Sitlali San Martin --}}
@include('posts.categorias.add_list_categorias')

                            
                            {{-- SE AÑADIÓ UN ICONO DE COMENTARIOS BY JORGE ALDAIR PÉREZ HERNÁNDEZ --}}
                            <div class="mt-4 flex space-x-4">
                                <a href="{{ route('posts.show', $post) }}" 
                                   class="text-blue-600 dark:text-blue-400 hover:underline text-sm flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                    </svg>
                                    Ver comentarios ({{ $post->comments->count() }})
                                </a>
                            </div>

                             @php
                                $userReaction = $post->reacciones->firstWhere('user_id', auth()->id());
                            @endphp

                                <div class="flex items-center gap-4 mt-4">
                                    {{-- BOTÓN LIKE --}}
                                    <form action="{{ route('posts.react', $post) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="is_like" value="1">
                                        <button type="submit"
                                                class="flex items-center gap-1 px-3 py-1.5 rounded-full border 
                                                    text-sm font-semibold shadow-sm transition-all duration-200
                                                    {{ $userReaction && $userReaction->is_like 
                                                        ? 'bg-green-600 text-white hover:bg-green-700' 
                                                        : 'bg-white text-green-600 border-green-500 hover:bg-green-50' }}">
                                            <x-heroicon-s-hand-thumb-up class="w-5 h-5 {{ $userReaction && $userReaction->is_like ? 'text-white' : 'text-green-600' }}" />
                                                ({{ $post->likes()->count() }})
                                        </button>
                                    </form>

                                    {{-- BOTÓN DISLIKE --}}
                                    <form action="{{ route('posts.react', $post) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="is_like" value="0">
                                        <button type="submit"
                                                class="flex items-center gap-1 px-3 py-1.5 rounded-full border 
                                                    text-sm font-semibold shadow-sm transition-all duration-200
                                                    {{ $userReaction && !$userReaction->is_like 
                                                        ? 'bg-red-600 text-white hover:bg-red-700' 
                                                        : 'bg-white text-red-600 border-red-500 hover:bg-red-50' }}">
                                            <x-heroicon-s-hand-thumb-down class="w-5 h-5 {{ $userReaction && !$userReaction->is_like ? 'text-white' : 'text-red-600' }}" />
                                                 ({{ $post->dislikes()->count() }})
                                        </button>
                                    </form>
                                </div>
                        </div>
                        @can('update', $post)
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg class="w-6 h-5 text-gray-300 bg-gray-600 rounded-md dark:text-gray-200 dark:hover:bg-gray-500 hover:rounded-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
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
    {{-- Mostrar el apartado de paginacion en los comentarios by Michelle Adriana Flores Mora --}}
@include('posts.image.paginate.paginate')

        </div>
    </div>
</x-app-layout>