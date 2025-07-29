<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foro Comunidad - @yield('title', 'Inicio')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/theme-toggle.js'])

</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-gray-900 dark:via-gray-800 dark:to-black min-h-screen text-gray-900 dark:text-gray-100">
    
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 via-blue-800 to-purple-800 dark:from-gray-100 dark:via-blue-300 dark:to-purple-300 bg-clip-text text-transparent mb-4">
                Bienvenido al Foro
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Conecta, discute y comparte conocimiento con nuestra comunidad
            </p>
        </div>


        <!-- Categories Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Categories List -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-900 dark:to-gray-800 border-b border-gray-100 dark:border-gray-700">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                            </svg>
                            Categorías del Foro
                        </h2>
                    </div>
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($categories ?? [] as $category)
                            <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors duration-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 hover:text-blue-600 transition-colors duration-200">
                                                <a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                                            </h3>
                                            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $category->description }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-medium">{{ $category->topics_count ?? 0 }}</span> temas
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-medium">{{ $category->posts_count ?? 0 }}</span> posts
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <!-- Categorías de ejemplo -->
                            <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors duration-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 hover:text-blue-600 transition-colors duration-200">
                                                <a href="#">Desarrollo Web</a>
                                            </h3>
                                            <p class="text-gray-600 dark:text-gray-400 mt-1">Discusiones sobre HTML, CSS, JavaScript y frameworks</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-medium">45</span> temas
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-medium">312</span> posts
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors duration-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 hover:text-green-600 transition-colors duration-200">
                                                <a href="#">Bases de Datos</a>
                                            </h3>
                                            <p class="text-gray-600 dark:text-gray-400 mt-1">Consultas, diseño y optimización</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-medium">30</span> temas
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-medium">245</span> posts
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors duration-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 hover:text-pink-600 transition-colors duration-200">
                                                <a href="#">Diseño UI/UX</a>
                                            </h3>
                                            <p class="text-gray-600 dark:text-gray-400 mt-1">Tendencias y mejores prácticas</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-medium">20</span> temas
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-medium">180</span> posts
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Temas Recientes</h2>
                <ul class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($recentTopics ?? [] as $topic)
                        <li class="py-2">
                            <a href="{{ route('topic.show', $topic->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline font-semibold">
                                {{ Str::limit($topic->title, 50) }}
                            </a>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                por {{ $topic->user->name ?? 'Usuario' }} • {{ $topic->created_at->diffForHumans() }}
                            </p>
                        </li>
                    @empty
                        <li class="py-2">
                            <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline font-semibold">
                                Introducción al foro
                            </a>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                por Admin • Hace 2 días
                            </p>
                        </li>
                        <li class="py-2">
                            <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline font-semibold">
                                Normas y pautas del foro
                            </a>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                por Admin • Hace 4 días
                            </p>
                        </li>
                    @endforelse
                </ul>
            </aside>
        </div>
    </main>

    <!-- Footer -->
    <footer class="mt-12 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-600 dark:text-gray-400">
            © {{ date('Y') }} ForoComunidad. Todos los derechos reservados.
        </div>
    </footer>
</body>
</html>