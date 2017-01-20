const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass([
    			'bootstrap.scss',
    			'global/plugins/select2/sass/select2-bootstrap.min.scss',
    			'global/*.scss',
    			'apps/*.scss',
    			'pages/*.scss',
    			'layouts/layout/*.scss'
    		])
       .sass('layouts/layout/themes/*.scss','public/themes/')
       .webpack([
       				'app.js',
       				'global/plugins/js.cookie.min.js',
       				'global/plugins/jquery-slimscroll/jquery.slimscroll.js',
       				'global/plugins/jquery.blockui.min.js',
       				'global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
              'global/plugins/moment.min.js',
              'global/plugins/bootstrap-daterangepicker/daterangepicker.min.js',
              'global/plugins/morris/morris.min.js',
              'global/plugins/morris/raphael-min.js',
              'global/plugins/counterup/jquery.waypoints.min.js',
              'global/plugins/counterup/jquery.counterup.min.js',
              'global/plugins/amcharts/amcharts/amcharts.js',
              'global/plugins/amcharts/amcharts/serial.js',
              'global/plugins/amcharts/amcharts/pie.js',
              'global/plugins/amcharts/amcharts/radar.js',
              'global/plugins/amcharts/amcharts/themes/light.js',
              'global/plugins/amcharts/amcharts/themes/patterns.js',
              'global/plugins/amcharts/amcharts/themes/chalk.js',
              'global/plugins/amcharts/ammap/ammap.js',
              'global/plugins/amcharts/ammap/maps/js/worldLow.js',
              'global/plugins/amcharts/amstockcharts/amstock.js',
              'global/plugins/fullcalendar/fullcalendar.min.js',
              'global/plugins/horizontal-timeline/horizontal-timeline.js',
              'global/plugins/flot/jquery.flot.min.js',
              'global/plugins/flot/jquery.flot.resize.min.js',
              'global/plugins/flot/jquery.flot.categories.min.js',
              'global/plugins/jquery-easypiechart/jquery.easypiechart.min.js',
              'global/plugins/jquery.sparkline.min.js',
              'global/plugins/jqvmap/jqvmap/jquery.vmap.js',
              'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js',
              'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js',
              'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js',
              'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js',
              'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js',
              'global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js',
              'global/scripts/app.min.js',
              
              'pages/scripts/dashboard.min.js',
              'layouts/layout/scripts/layout.min.js',
              'layouts/layout/scripts/demo.min.js',
              'layouts/global/scripts/quick-sidebar.min.js',
              'layouts/global/scripts/quick-nav.min.js'
       			]);
});