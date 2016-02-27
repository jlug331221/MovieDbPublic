var elixir = require('laravel-elixir');

var settings = require('./.env.gulp.js');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass(['app.scss', 'adminDashBoard.scss']);

    if(settings.version) {
        mix.version(['public/css/app.css',
            'public/css/adminDashBoard.css']);
    }

    if(settings.browsersync) {
        mix.browserSync({proxy: settings.hostpath});
    }
});
