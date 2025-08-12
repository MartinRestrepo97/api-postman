module.exports = {
    darkMode: 'class',
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                'filament-bg': '#18181b', // fondo oscuro personalizado
                'filament-card': '#23232a', // zona de formulario
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
