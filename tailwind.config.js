import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue', // Make sure this matches the path where your Vue components are located

    ],

    theme: {
        extend: {
            colors: {
                yellow: {
                    100: 'rgba(255, 233, 161, 1)',
                    300: 'rgba(255, 219, 99, 1)',
                },
                black: {
                    100: 'rgba(44, 43, 43, 1)', 
                },
                transparency:{
                    100: 'rgba(255,255,255,0.4)',
                },
                light_green:{
                    100: '#b5ffb8',
                    200: '#a1e2a8',
                },
                grey: {
                    100: '#5a5a5a'
                },
            },
            fontFamily: {
                sans: ['Inter', 'Helvetica', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                small: '20px',
                normal: '26px',
                large: '40px',
            },
        },
    },

    plugins: [forms],
};
