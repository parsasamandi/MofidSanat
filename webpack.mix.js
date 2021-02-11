const mix = require('laravel-mix');
const CompressionPlugin = require('compression-webpack-plugin');

mix.setPublicPath('public');
mix.setResourceRoot('../');


// Mix
mix.js('resources/assets/js/app.js',  'public/js')
    .sass('resources/assets/sass/app.scss','public/css')
    // Home
    .styles('resources/assets/sass/main.scss','public/css/main.css')
    // Authentication
    .styles('resources/assets/sass/auth.scss','public/css/auth.css')
    // DataTable Persian Language
    .scripts('resources/assets/js/Persian.json','public/js/Persian.json')
    // Isotope
    .scripts('resources/assets/js/isotope.js','public/js/isotope.json')
    // Home Js
    .scripts('resources/assets/js/main.js','public/js/main.js')
    // DataTable Persian Language
    .scripts('resources/assets/js/Persian.json','public/js/Persian.json')
    // Isotope
    .scripts('resources/assets/js/isotope.js','public/js/isotope.json');

// Images
mix.copy('resources/assets/images', 'public/images');
// Ajax Request Handler
mix.copy('resources/assets/js/requestHandler.js', 'public/js/requestHandler.js');
// Fonts
mix.copy('resources/assets/fonts','public/fonts');

mix.version();
mix.extract();
mix.disableNotifications();

