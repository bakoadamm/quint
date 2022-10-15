const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/assets/js')
    .js('resources/js/bootstrap.bundle.min.js', 'public/assets/js')

    .js('resources/dashboard/js/helpers.js', 'public/assets/dashboard/js')
    .js('resources/dashboard/js/jquery.js', 'public/assets/dashboard/js')
    .js('resources/dashboard/js/popper.js', 'public/assets/dashboard/js')
    .js('resources/dashboard/js/main.js', 'public/assets/dashboard/js')
    .js('resources/dashboard/js/menu.js', 'public/assets/dashboard/js')
    .js('resources/dashboard/js/perfect-scrollbar.js', 'public/assets/dashboard/js')
    .js('resources/dashboard/js/config.js', 'public/assets/dashboard/js')
    .js('resources/dashboard/js/apexcharts.js', 'public/assets/dashboard/js')
    .js('resources/dashboard/js/editor.js', 'public/assets/dashboard/js')

    //.postCss('resources/css/bootstrap.min.css', 'public/assets/css', [])
    .postCss('resources/dashboard/css/perfect-scrollbar.css', 'public/assets/dashboard/css', [])
    .postCss('resources/dashboard/css/theme-default.css', 'public/assets/dashboard/css', [])
    .postCss('resources/dashboard/css/core.css', 'public/assets/dashboard/css', [])
    .postCss('resources/dashboard/css/demo.css', 'public/assets/dashboard/css', [])
    .postCss('resources/dashboard/css/page-auth.css', 'public/assets/dashboard/css', [])
    .postCss('resources/dashboard/css/page-misc.css', 'public/assets/dashboard/css', [])
    .postCss('resources/dashboard/css/apex-charts.css', 'public/assets/dashboard/css', [])
    .postCss('resources/dashboard/fonts/boxicons.css', 'public/assets/dashboard/fonts', [])
    .sass('resources/sass/app.scss', 'public/assets/css', [])
    .react()
    .copyDirectory('resources/dashboard/fonts/boxicons', 'public/assets/dashboard/fonts/boxicons');

mix.options({
    processCssUrls: false
});

mix.copy('resources/dashboard/img', 'public/assets/dashboard/img');
