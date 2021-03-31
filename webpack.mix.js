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
    .scripts('resources/assets/js/isotope.js','public/js/isotope.js')
    // Ajax Request Handler
    .copy('resources/assets/js/RequestHandler.js', 'public/js/RequestHandler.js')
    // Fonts
    .copy('resources/assets/fonts','public/fonts');

mix.sourceMaps();
mix.version();
mix.extract();
mix.disableNotifications();

