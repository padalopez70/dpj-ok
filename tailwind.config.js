const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/mediconesystems/livewire-datatables/resources/views/livewire/datatables/*.blade.php',
        './vendor/wire-elements/modal/resources/views/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: [
                    'Nunito', ...defaultTheme.fontFamily.sans
                ],
            },
        },
    },

    variants: {
        extend: {},
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography')
    ],

    darkMode: '',
};
