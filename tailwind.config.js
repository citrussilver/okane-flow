import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'jp-indigo': 'rgb(41, 61, 77)',
                'ceil': 'rgb(147, 174, 197)',
                'lite-steel-blue': 'rgb(175, 197, 220)',
                'columbia-blue': 'rgb(198, 214, 226)',
                'azureish-white': 'rgb(216, 227, 235)',
                'anti-flash-white': 'rgb(235, 242, 246)',
                'pastel-gray': 'rgb(201, 213, 192)',
                'beige': 'rgb(245, 238, 223)',
                'timberwolf': 'rgb(224, 220, 209)',
                'spanish-gray': 'rgb(156, 156, 156)',
                'independence': 'rgb(81, 73, 99)'
            }
        },
    },

    plugins: [forms],
};
