const mix = require('laravel-mix');
const CompressionPlugin = require('compression-webpack-plugin');

mix.setPublicPath('public');
mix.setResourceRoot('../');

// Home
mix.styles('resources/assets/sass/main.scss','public/css/main.css');
// Admin Bootstrap Rtl
mix.styles('resources/assets/sass/admin/bootstrap-rtl.scss','public/css/bootstrap-rtl.css');
// Authentication
mix.styles('resources/assets/sass/auth.scss','public/css/auth.css');
// Home Js
mix.scripts('resources/assets/js/main.js','public/js/main.js');
// DataTable Persian Language
mix.scripts('resources/assets/js/Persian.json','public/js/Persian.json');
// Isotope
mix.scripts('resources/assets/js/isotope.js','public/js/isotope.json');
// Admin Js
mix.scripts('resources/assets/js/admin.js', 'public/js/admin.js');
// Mix
mix.js('resources/assets/js/app.js',  'public/js')
    .sass('resources/assets/sass/app.scss','public/css')
// Images
mix.copy('resources/assets/images', 'public/images');
// Fonts
mix.copy('resources/assets/fonts','public/fonts');

mix.version();
mix.extract();
mix.disableNotifications();

