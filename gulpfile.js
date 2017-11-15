var elixir = require('laravel-elixir'),
    gulp = require('gulp'),
    wiredep = require('wiredep').stream,
    bower = require('main-bower-files');
    //uglify = require('laravel-elixir-uglify');
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
require('laravel-elixir-stylus');

elixir(function(mix) {
    mix.sass('app.scss');
    //mix.scripts(bower('**/*.js'), './public/js/bower.js', '/');
    //mix.scripts(['./public/js/bower.js', './resources/assets/js/main.js'] , 'public/js/all.js', '/');
    mix.scripts([
        './bower_components/jquery/dist/jquery.js',
        './bower_components/bootstrap/dist/js/bootstrap.js',
        './bower_components/jquery.maskMoney/dist/jquery.maskMoney.js',
        './bower_components/SlidesJS/source/jquery.slides.js',
        './bower_components/jquery-colorbox/jquery.colorbox.js',
        './bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.js',
        './bower_components/vue/dist/vue.js',
        './bower_components/vue-resource/dist/vue-resource.js',
        './bower_components/bootstrap-select/dist/js/bootstrap-select.js',
        './resources/assets/js/main.js'] , 'public/js/all.js', '/');
    mix.stylus('style.styl');
    mix.styles([
        './public/css/sale.css',
        './bower_components/jquery-colorbox/example1/colorbox.css',
        './bower_components/font-awesome/css/font-awesome.css',
        './bower_components/bootstrap-select/dist/css/bootstrap-select.css',
        './public/css/style.css',
    ], 'public/css/all.css');
    mix.copy('./bower_components/jquery-colorbox/example1/images/**.*', 'public/css/images');
    mix.copy('./bower_components/font-awesome/fonts/**.*', 'public/fonts');
    mix.copy('./bower_components/bootstrap/fonts/**.*', 'public/css/fonts');

    //admin
    mix.scripts([
        './bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js',
        './bower_components/AdminLTE/bootstrap/js/bootstrap.js',
        './bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js',
        './bower_components/AdminLTE/plugins/fastclick/fastclick.js',
        './bower_components/AdminLTE/dist/js/app.min.js',
        './bower_components/AdminLTE/dist/js/demo.js',
    ] , 'public/admin/js/all.js', '/');
    mix.styles([
        './bower_components/AdminLTE/bootstrap/css/bootstrap.css',
        './bower_components/AdminLTE/dist/css/skins/_all-skins.css',
        './bower_components/AdminLTE/dist/css/AdminLTE.css',
    ], 'public/admin/css/all.css');
    mix.copy('./bower_components/AdminLTE/dist/img/**.*', 'public/admin/css/images');

    mix.browserSync({
        proxy: 'cars2.dev'
    });
});
