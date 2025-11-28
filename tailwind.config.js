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
                brand: {
                    dark: '#0C2B4E',    // Dark Navy
                    primary: '#1D546C', // Teal/Blue (Primary Action)
                    secondary: '#1A3D64', // Medium Blue
                    light: '#F4F4F4',   // Off-White
                    white: '#FFFFFF',
                }
            },
        },
    },

    plugins: [forms],
};
