let mix = require('laravel-mix');
let fs = require('fs');
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
    npm + 'jquery/dist/jquery.js',
    npm + 'bootstrap/dist/js/bootstrap.min.js',
    npm + 'image-map-resizer/js/imageMapResizer.min.js',
    vendors + 'helpers.js',
    vendors + 'prototypes.js',
], 'assets/dist/js/' + outputJS.vendor)
.styles([
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
| Copy assets
|--------------------------------------------------------------------------
*/
if (fs.existsSync('assets/src/front/images'))
{
    mix.copyDirectory('assets/src/front/images', 'assets/dist/images');
}
if (fs.existsSync('assets/src/front/favicons')) 
{
    mix.copyDirectory('assets/src/front/favicons', 'assets/dist/favicons');
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
| Mix front styles and scripts
|--------------------------------------------------------------------------
*/
mix.js('assets/src/admin/js/app.js', 'assets/dist/js/' + outputJS.admin)
.sass('assets/src/admin/sass/app.scss', 'assets/dist/css/' + outputCSS.admin);
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