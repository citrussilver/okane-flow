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
                'independence': 'rgb(81, 73, 99)',
                'cafe-noir': 'rgb(78, 46, 29)',
                'black-choco': 'rgb(31, 23, 20)',
                'munsell-yellow': 'rgb(244, 203, 1)',
                'yellow-orange': 'rgb(255, 152, 10)',
                'inbike-green': 'rgb(111, 201, 209)',
                'inbike-dgreen': 'rgb(68, 97, 99)',
                'quincy': 'rgb(113, 81, 72)',
                'pokedex-normal': 'rgb(159, 161, 159)',
                'pokedex-fire': 'rgb(230, 40, 41)',
                'pokedex-fighting': 'rgb(255, 128, 0)',
                'pokedex-water': 'rgb(41, 128, 239)',
                'pokedex-flying': 'rgb(129, 185, 239)',
                'pokedex-grass': 'rgb(63, 161, 41)',
                'pokedex-poison': 'rgb(145, 65, 203)',
                'pokedex-electric': 'rgb(250, 192, 0)',
                'pokedex-ground': 'rgb(145, 81, 33)',
                'pokedex-psychic': 'rgb(239, 65, 121)',
                'pokedex-rock': 'rgb(175, 169, 129)',
                'pokedex-ice': 'rgb(61, 206, 243)',
                'pokedex-bug': 'rgb(145, 161, 25)',
                'pokedex-dragon': 'rgb(80, 96, 225)',
                'pokedex-ghost': 'rgb(112, 65, 112)',
                'pokedex-dark': 'rgb(98, 77, 78)',
                'pokedex-steel': 'rgb(96, 161, 184)',
                'pokedex-fairy': 'rgb(239, 112, 239)',
                'pokedex-stellar': 'rgb(64, 181, 165)'
            }
        },
    },

    plugins: [forms],
};
