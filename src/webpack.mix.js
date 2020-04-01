const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        postCss: [
            require('postcss-pxtorem')({
                propList: ['*'],
                selectorBlackList: ['border'],
                mediaQuery: true,
            }),
        ],
    });

mix.browserSync({
    proxy: 'nginx',
    open: false,
    ui: false,
    port: 8080,
});

mix.copyDirectory('resources/images', 'public/images');
