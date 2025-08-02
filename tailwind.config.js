import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', 
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js', 
    ],

    safelist: [
        // === Clases usadas en config/category.php by Sitlali San Martin ===
        'bg-blue-100', 'text-blue-800', 'dark:bg-blue-900', 'dark:text-blue-100',
        'bg-green-100', 'text-green-800', 'dark:bg-green-900', 'dark:text-green-100',
        'bg-purple-100', 'text-purple-800', 'dark:bg-purple-900', 'dark:text-purple-100',
        'bg-red-100', 'text-red-800', 'dark:bg-red-900', 'dark:text-red-100',
        'bg-yellow-100', 'text-yellow-800', 'dark:bg-yellow-900', 'dark:text-yellow-100',
        'bg-pink-100', 'text-pink-800', 'dark:bg-pink-900', 'dark:text-pink-100',
        'bg-indigo-100', 'text-indigo-800', 'dark:bg-indigo-900', 'dark:text-indigo-100',
        'bg-orange-100', 'text-orange-800', 'dark:bg-orange-900', 'dark:text-orange-100',
        'bg-teal-100', 'text-teal-800', 'dark:bg-teal-900', 'dark:text-teal-100',
        'bg-emerald-100', 'text-emerald-800', 'dark:bg-emerald-900', 'dark:text-emerald-100',
        'bg-gray-100', 'text-gray-800', 'dark:bg-gray-800', 'dark:text-gray-100',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
