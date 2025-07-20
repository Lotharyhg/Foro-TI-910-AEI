{{-- CREACION DE VISTA "SHOW" PARA MOSTRAR EL POST Y COMENTARIOS DE LOS USUARIOS BY JORGE ALDAIR PÉREZ HERNÁNDEZ --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-sm text-gray-800 dark:text-orange-300 leading-tight">
            {{ __('Post Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-gray-600 dark:text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <span class="text-gray-800 dark:text-gray-200 font-medium">
                                    {{$post->user->name}}
                                </span>
                                <small class="ml-2 text-sm text-gray-600 dark:text-gray-300">
                                    {{$post->created_at->format('d M Y g:i a')}}
                                </small>
                                @unless ($post->created_at->eq($post->updated_at))
                                    <small class="text-md text-gray-600 dark:text-gray-300"> &middot; {{__('Edited')}}</small>
                                @endunless
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">
                            {{$post->message}}
                            @include('posts.image.add_list_image')              
                             {{-- Agregar la categpria a la lista de posts by Sitlali San Martin --}}
                            @include('posts.categorias.add_list_categories')
                        </p>
                        
                        <div class="mt-4">
                            <a href="{{route('posts.index')}}" 
                               class="text-blue-600 dark:text-blue-400 hover:underline text-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                                </svg>
                                Volver a posts
                            </a>
                        </div>
                    </div>
                </div>
            </div>

<div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-gray-600 dark:text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
            </svg>
            Comentarios ({{ $post->comments->count() }})
        </h3>
        
        <div class="mb-6 border-b border-gray-200 dark:border-gray-700 pb-6">
            <form action="{{ route('comments.store', $post) }}" method="POST">
                @csrf
                <div class="flex space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-medium">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 transition-all">
                            <textarea name="content"
                                      placeholder="¿Qué opinas sobre este post?"
                                      class="w-full border-0 bg-transparent resize-none focus:ring-0 p-3 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 @error('content') border-red-500 @enderror"
                                      rows="3"
                                      style="outline: none; box-shadow: none;">{{ old('content') }}</textarea>
                            
                            {{-- Barra de acciones --}}
                            <div class="flex justify-end items-center px-3 py-2 border-t border-gray-200 dark:border-gray-600">
                                <button type="submit" 
                                        class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition-colors font-medium">
                                    Comentar
                                </button>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('content')" class="mt-2"/>
                    </div>
                </div>
            </form>
        </div>
        
        @if($post->parentComments->count() > 0)
            <div class="space-y-1">
                @foreach ($post->parentComments as $comment)
                    @include('comments.comment', ['comment' => $comment, 'level' => 0])
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <div class="text-gray-400 dark:text-gray-500 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-12 h-12 mx-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>
                </div>
                <p class="text-gray-500 dark:text-gray-400 text-sm">
                    No hay comentarios aún. ¡Sé el primero en comentar!
                </p>
            </div>
        @endif
    </div>
</div>
</x-app-layout>