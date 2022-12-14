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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .js('resources/js/registration.js', 'public/js')
    .js('resources/js/payment.js', 'public/js')
    .js('resources/js/activities.js', 'public/js')
    .js('resources/js/booking.js', 'public/js')
    .js('resources/js/attendance.js', 'public/js');
