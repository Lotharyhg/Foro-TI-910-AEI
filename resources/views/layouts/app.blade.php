<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind CDN para desarrollo -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Tema inicial para evitar parpadeos -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- Estilos adicionales -->
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Transición suave para el cambio de tema */
        * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-gray-900 dark:via-gray-800 dark:to-black min-h-screen text-gray-900 dark:text-gray-100">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Theme Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const html = document.documentElement;
            const themeToggleButton = document.getElementById('theme-toggle');
            const themeToggleButtonMobile = document.getElementById('theme-toggle-mobile');

            // Iconos para desktop
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');

            // Iconos para mobile
            const darkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
            const lightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');

            // Función para actualizar iconos
            const updateIcons = (theme) => {
                if (theme === 'dark') {
                    if (darkIcon && lightIcon) {
                        darkIcon.classList.remove('hidden');
                        lightIcon.classList.add('hidden');
                    }
                    if (darkIconMobile && lightIconMobile) {
                        darkIconMobile.classList.remove('hidden');
                        lightIconMobile.classList.add('hidden');
                    }
                } else {
                    if (darkIcon && lightIcon) {
                        darkIcon.classList.add('hidden');
                        lightIcon.classList.remove('hidden');
                    }
                    if (darkIconMobile && lightIconMobile) {
                        darkIconMobile.classList.add('hidden');
                        lightIconMobile.classList.remove('hidden');
                    }
                }
            };

            // Función para aplicar el tema
            const applyTheme = (theme) => {
                if (theme === 'dark') {
                    html.classList.add('dark');
                } else {
                    html.classList.remove('dark');
                }
                updateIcons(theme);
            };

            // Detectar tema inicial
            const initTheme = () => {
                const savedTheme = localStorage.getItem('theme');
                if (savedTheme) {
                    applyTheme(savedTheme);
                }
            };

            initTheme();

            const toggleTheme = () => {
                const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                applyTheme(newTheme);
                localStorage.setItem('theme', newTheme);
            };

            if (themeToggleButton) {
                themeToggleButton.addEventListener('click', toggleTheme);
            }

            if (themeToggleButtonMobile) {
                themeToggleButtonMobile.addEventListener('click', toggleTheme);
            }

            window.toggleTheme = toggleTheme;
        });
    </script>

    @stack('scripts')
</body>
</html>
