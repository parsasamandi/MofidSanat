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
    // Isotope
    .js('resources/assets/js/isotope.js','public/js/isotope.json')
    // Home js
    .js('resources/assets/js/main.js','public/js/main.js')
    // DataTable persian language
    .js('resources/assets/js/persian.json','public/js/persian.json')
    // Isotope
    .js('resources/assets/js/isotope.js','public/js/isotope.js')
    // Ajax request handler
    .scripts('resources/assets/js/RequestHandler.js', 'public/js/RequestHandler.js')
    // Fonts
    .copy('resources/assets/fonts','public/fonts');

mix.sourceMaps();
mix.version();
mix.extract();
mix.disableNotifications();

