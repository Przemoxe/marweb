let mix = require('laravel-mix');
let fs = require('fs');
require('laravel-mix-scrollmagic-gsap');
let npm = 'node_modules/';
let vendors = 'assets/src/front/js/vendors/';

let outputJS = {
    main: mix.inProduction() ? 'bundle.js' : 'build.js',
    vendor: mix.inProduction() ? 'bundle-vendor.js' : 'build-vendor.js',
    print: mix.inProduction() ? 'bundle-print.js' : 'build-print.js'
};
let outputCSS = {
    main: mix.inProduction() ? 'bundle.css' : 'build.css',
    front: mix.inProduction() ? 'bundle-front.css' : 'build-front.css',
    vendor: mix.inProduction() ? 'bundle-vendor.css' : 'build-vendor.css',
    print: mix.inProduction() ? 'bundle-print.css' : 'build-print.css'
};
/*
|--------------------------------------------------------------------------
| Mix vendors
|--------------------------------------------------------------------------
*/
mix.scripts([
    npm + 'jquery/dist/jquery.js',
    // npm + 'bootstrap/dist/js/bootstrap.min.js',
    npm + 'popper/dist/js/popper.js',
    npm + 'nouislider/distribute/nouislider.js',
    npm + 'wnumb/wNumb.js',
    vendors + 'helpers.js',
    vendors + 'prototypes.js',
], 'assets/dist/js/' + outputJS.vendor)
.styles([
    npm + 'jquery-ui-dist/jquery-ui.css',
], 'assets/dist/css/' + outputCSS.vendor)
/*
|--------------------------------------------------------------------------
| Mix front styles and scripts
|--------------------------------------------------------------------------
*/
.js('assets/src/front/js/app.js', 'assets/dist/js/' + outputJS.main)
.sass('assets/src/front/sass/app.scss', 'assets/dist/css/' + outputCSS.main)
.sass('assets/src/front/sass/front-page.scss', 'assets/dist/css/' + outputCSS.front)
/*
|--------------------------------------------------------------------------
| Mix print styles and scripts
|--------------------------------------------------------------------------
*/
// .js('assets/src/front/js/print.js', 'assets/dist/js/' + outputJS.print)
.sass('assets/src/front/sass/print.scss', 'assets/dist/css/' + outputCSS.print)
/*
|--------------------------------------------------------------------------
| Copy assets
|--------------------------------------------------------------------------
*/
if (fs.existsSync('assets/src/front/images'))
{
    mix.copyDirectory('assets/src/front/images', 'assets/dist/images');
}
if (fs.existsSync('assets/src/front/fonts'))
{
    mix.copyDirectory('assets/src/front/fonts', 'assets/dist/fonts');
}
if (fs.existsSync('assets/src/front/js/vendors/tinymce'))
{
    mix.copyDirectory('assets/src/front/js/vendors/tinymce', 'assets/dist/js/tinymce');
}
/*
|--------------------------------------------------------------------------
| Options and webpack configuration
|--------------------------------------------------------------------------
*/
mix.setPublicPath('assets/dist')
.options({
    processCssUrls: false,
})
.webpackConfig({
    output: {
        publicPath: '/assets/dist',
        chunkFilename: 'js/[name].[chunkhash].js'
    },
    module: {
        rules: [
            {
                test: /\.js?$/,
                exclude: /node_modules(?!\/foundation-sites)|bower_components/,
                use: [{
                    loader: 'babel-loader',
                    options: {
                        cacheDirectory: true
                    }
                }]
            }
        ]
    }
});

/*
    scrollmagic fix
*/

mix.scrollmagicGSAP();