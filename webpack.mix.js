const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/*mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');*/

mix.scripts([
    "node_modules/popper.js/dist/umd/popper.js",
    "node_modules/jquery/dist/jquery.js",
    "node_modules/bootstrap/dist/js/bootstrap.js",
    'resources/js/app.js',
    "node_modules/select2/dist/js/select2.js"
], 'public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/select2/dist/css/select2.css', 'public/css/select2');

mix.scripts([
    'node_modules/admin-lte/plugins/jquery/jquery.js',
    'node_modules/admin-lte/plugins/bootstrap/js/bootstrap.js',
    'node_modules/admin-lte/plugins/popper/umd/popper.js',
    'node_modules/admin-lte/dist/js/adminlte.js'
], 'public/js/admin.js')
    /* .scripts([

     ], )*/
    //.sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css/admin')
    .copy('node_modules/admin-lte/plugins/fontawesome-free/webfonts', 'public/fonts');
