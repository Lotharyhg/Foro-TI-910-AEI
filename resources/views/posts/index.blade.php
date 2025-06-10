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
                    {{-- @dump($errors->get('message')) --}}
                    </div>
                    {{-- Aquí empieza el formulario de publicaciones --}}
                    <form action="{{route('posts.store')}}" method="POST">
                        @csrf
                        <textarea name="message"
                                  placeholder="{{__('What\'s do you think?')}}"
                                  class="mt-6 block w-full rounded-md bg-white shadow-sm
                                         focus:border-indigo-200 focus:ring focus:ring-yellow-200 focus:ring-opacity-50
                                         dark:dark:bg-gray-800 dark:text-white
                                         dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 
                                         dark:focus:ring-opacity-50
                                         @error('message') border-red-500 @enderror"
                        >{{old('message')}}</textarea>
                        {{-- Errores validaciones con Blade --}}
                        {{-- <div class="mt-3 text-red-300"> @error('message') {{$message}} @enderror </div> --}}
                        {{-- Errores validaciones con tailwind --}}
                        <x-input-error :messages="$errors->get('message')"/>
                        <x-primary-button class="mt-6">
                            {{__("Posting")}}
                        </x-primary-button>
                    </form>
                </div>
            </div>

            {{-- Aquí empieza mi lista de posts --}}
            @foreach ($posts as $post)
            <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
                <div class="p-6 flex space-x-2">
                    <svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 2.25c-2.429 0-4.817.178-7.152.521C2.87 3.061 1.5 4.795 1.5 6.741v6.018c0 1.946 1.37 3.68 3.348 3.97.877.129 1.761.234 2.652.316V21a.75.75 0 0 0 1.28.53l4.184-4.183a.39.39 0 0 1 .266-.112c2.006-.05 3.982-.22 5.922-.506 1.978-.29 3.348-2.023 3.348-3.97V6.741c0-1.947-1.37-3.68-3.348-3.97A49.145 49.145 0 0 0 12 2.25ZM8.25 8.625a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25Zm2.625 1.125a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875-1.125a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25Z" clip-rule="evenodd" />
                    </svg>

                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800 dark:text-gray-200 mt-5 pb-2">
                                   {{$post->user->name}}
                                </span>
                                <small class="ml-2 text-sm text-gray-600 dark:text-gray-300">
                                    {{-- {{$post->created_at->diffForHumans()}} --}}
                                    {{$post->created_at->format('d M Y g:i a')}}
                                </small>
                                @unless ($post->created_at->eq($post->updated_at))  {{--// eq lt gt lte gte --}}
                                    <small class="text-md text-gray-600 dark:text-gray-300"> &middot; {{__('Edited')}}</small>
                                @endunless
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900 dark:text-gray-100"> 
                            {{$post->message}}
                        </p>
                    </div>
                    {{-- Inicio del menu editar y eliminar --}}
                    {{-- Método que funciona con las politicas de control --}}
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
                                {{__('Edit')}}
                            </x-dropdown-link>
                            <div x-data="{ showConfirm: false}">
                                <form id="delete-post-form-{{$post->id}}" action="{{ route('posts.destroy', $post)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                        {{-- Botón para abri el modal --}}
                                        <x-dropdown-link href="#" x-on:click.stop.prevent="showConfirm = true">
                                            {{__('Delete')}}
                                        </x-dropdown-link>
                                </form>
                                {{-- Modal de confirmación Diseño y Envio de confirmación de eliminar --}}
                                <div x-show="showConfirm" x-cloak class="fixed inset-0 flex items-center justify-center bg-black/50 p-4" x-on:click="showConfirm= false">
                                    {{-- Encabezado Modal --}}
                                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-80">
                                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                            {{__('Are you sure you want to delete this post?')}}
                                        </h2>
                                        <p class="text-gray-600 dark:text-gray-300 mt-2 text-sm">
                                            {{__('This action cannot be undone!')}}
                                        </p>
                                    
                                    {{-- Contenido Modal --}}
                                    <div class="mt-4 flex justify-end space-x-2">
                                        <button x-on:click="showConfirm = false"
                                                class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-600">
                                            {{__('No, Keep it!')}}
                                        </button>
                                        <button x-on:click="document.getElementById('delete-post-form-{{$post->id}}').submit()"
                                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                            {{__('Yes, Delete it!')}}
                                        </button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </x-slot>    
                    </x-dropdown>
                    @endcan
                    {{-- Fin del menu de edición --}}
                </div>
            </div>
            @endforeach
            {{-- Aquí termina de lista de posts --}}

        </div>
    </div>

    
</x-app-layout>

