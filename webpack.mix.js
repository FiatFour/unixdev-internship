const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/dashmix/_scss/main.scss', 'public/css/dashmix')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .vue();
