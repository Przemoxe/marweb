let mix = require('laravel-mix');
require('laravel-mix-polyfill');
let npm = 'node_modules/';
let vendors = 'assets/src/front/js/vendors/';

let outputJS = {
    main: mix.inProduction() ? 'bundle.js' : 'build.js',
    admin: mix.inProduction() ? 'bundle-admin.js' : 'build-admin.js',
    vendor: mix.inProduction() ? 'bundle-vendor.js' : 'build-vendor.js',
    print: mix.inProduction() ? 'bundle-print.js' : 'build-print.js'
};
let outputCSS = {
    main: mix.inProduction() ? 'bundle.css' : 'build.css',
    admin: mix.inProduction() ? 'bundle-admin.css' : 'build-admin.css',
    vendor: mix.inProduction() ? 'bundle-vendor.css' : 'build-vendor.css',
    print: mix.inProduction() ? 'bundle-print.css' : 'build-print.css'
};
/*
|--------------------------------------------------------------------------
| Mix vendors
|--------------------------------------------------------------------------
*/
mix.scripts([
    npm + 'babel-polyfill/dist/polyfill.min.js',
    npm + 'jquery/dist/jquery.js',
    npm + 'jquery-ui-dist/jquery-ui.js',
    npm + 'jquery.cookie/jquery.cookie.js',
    npm + 'slick-carousel/slick/slick.js',
    npm + 'magnific-popup/dist/jquery.magnific-popup.js',
    // npm + 'foundation-sites/dist/js/foundation.js',
    npm + 'jquery-match-height/dist/jquery.matchHeight.js',
    npm + 'select2/dist/js/select2.full.min.js',
    vendors + 'helpers.js',
    vendors + 'prototypes.js',
    vendors + 'markerclusterer.js'
], 'assets/dist/js/' + outputJS.vendor)
.styles([
    npm + 'jquery-ui-dist/jquery-ui.css',
    npm + 'slick-carousel/slick/slick.css',
    npm + 'magnific-popup/dist/magnific-popup.css',
    npm + 'select2/dist/css/select2.min.css',
], 'assets/dist/css/' + outputCSS.vendor)
/*
|--------------------------------------------------------------------------
| Mix front styles and scripts
|--------------------------------------------------------------------------
*/
.js('assets/src/front/js/app.js', 'assets/dist/js/' + outputJS.main)
.sass('assets/src/front/sass/app.scss', 'assets/dist/css/' + outputCSS.main)
/*
|--------------------------------------------------------------------------
| Mix print styles and scripts
|--------------------------------------------------------------------------
*/
// .js('assets/src/front/js/print.js', 'assets/dist/js/' + outputJS.print)
// .sass('assets/src/front/sass/print.scss', 'assets/dist/css/' + outputCSS.print)
/*
|--------------------------------------------------------------------------
| Mix admin styles and scripts
|--------------------------------------------------------------------------
*/
.js('assets/src/admin/js/app.js', 'assets/dist/js/' + outputJS.admin)
.sass('assets/src/admin/sass/app.scss', 'assets/dist/css/' + outputCSS.admin)
/*
|--------------------------------------------------------------------------
| Copy assets
|--------------------------------------------------------------------------
*/
.copyDirectory('assets/src/front/images', 'assets/dist/images')
.copyDirectory('assets/src/front/fonts', 'assets/dist/fonts')
/*
|--------------------------------------------------------------------------
| Options and webpack configuration
|--------------------------------------------------------------------------
*/
.setPublicPath('assets/dist')
.options({
    processCssUrls: false,
})
.polyfill({
    enabled: true,
    useBuiltIns: 'usage',
    targets: '>= 0.5%, IE >=9'
})

.webpackConfig({
    output: {
        publicPath: '/assets/dist',
        chunkFilename: 'js/[name].[chunkhash].js'
    },
});
