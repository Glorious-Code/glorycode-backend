import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import colors from "tailwindcss/colors.js";

/** @type {import('tailwindcss').Config} */
export default {
    important: true,
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './node_modules/flowbite/**/*.js',
    ],

    plugins: [forms, require('flowbite-typography'), require('flowbite/plugin'), require('@tailwindcss/typography')],
    darkMode: 'media',
    theme: {
        fontFamily: {
            'body': ['Inter'],
            'sans': ['Inter']
        },
        extend: {
            colors: {
                primary: colors.amber
            }
        },
    },
};
