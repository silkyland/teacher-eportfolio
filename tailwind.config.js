import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Noto Sans Thai', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#f0f9ff',
                    500: '#0ea5e9',
                    600: '#0284c7',
                    700: '#0369a1',
                    800: '#075985',
                },
                accent: {
                    400: '#fb923c',
                    500: '#f97316',
                    600: '#ea580c',
                },
            },
        },
    },

    plugins: [forms],
};
