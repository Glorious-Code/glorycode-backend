import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './node_modules/flowbite/**/*.js',
    ],

    plugins: [forms, require('flowbite-typography'), require('flowbite/plugin')],
    darkMode: 'media',
    theme: {
        extend: {
            colors: {
                primary: { "50": "#EBF5FF", "100": "#E1EFFE", "200": "#C3DDFD", "300": "#A4CAFE", "400": "#76A9FA", "500": "#3F83F8", "600": "#1C64F2", "700": "#1A56DB", "800": "#1E429F", "900": "#233876" }
            }
        },
    },
};
