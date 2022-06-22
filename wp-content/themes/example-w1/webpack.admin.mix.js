let mix = require('laravel-mix');
let fs = require('fs');

let outputJS = {
    admin: mix.inProduction() ? 'bundle-admin.js' : 'build-admin.js',
};
let outputCSS = {
    admin: mix.inProduction() ? 'bundle-admin.css' : 'build-admin.css',
};
/*
|--------------------------------------------------------------------------
| Mix admin styles and scripts
|--------------------------------------------------------------------------
*/
mix.js('assets/src/admin/js/app.js', 'assets/dist/js/' + outputJS.admin)
.sass('assets/src/admin/sass/app.scss', 'assets/dist/css/' + outputCSS.admin)
/*
|--------------------------------------------------------------------------
| Copy assets
|--------------------------------------------------------------------------
*/
if (fs.existsSync('assets/src/admin/images'))
{
    mix.copyDirectory('assets/src/admin/images', 'assets/dist/images');
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