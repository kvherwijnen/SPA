/*
 * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 *
 * Copyright (c) 2020
 * All Rights Reserved
 * Licensed use only
 *
 * This product is part of the SheepCompany Incorporated
 *
 *
 * LICENSE BY:
 * Artificial Intelligence :: Sheep-AI.com
 * More information: LICENSE.txt
 *
 * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 */

const mix = require('laravel-mix');
const ScriptsPath = 'resources/assets/scripts/';
const StylesPath = 'resources/assets/styles/';
const PublicPath = 'public/';
const isProduction = process.env.NODE_ENV === 'production';

if (!isProduction)
    require('laravel-mix-artisan-serve');

let OfflinePlugin;
let CompressionPlugin;

if (isProduction) {
    OfflinePlugin = require('offline-plugin');
    CompressionPlugin = require('compression-webpack-plugin');
}

mix.babelConfig( {"presets": ["@babel/preset-env"], "plugins": ["@babel/plugin-syntax-dynamic-import"]})
    .js(ScriptsPath + 'app.js', 'app.js')

    .sass(StylesPath + 'element/index.scss', 'assets/css/element.min.css',
        {implementation: require('node-sass'), sassOptions: {precision: 5}})
    .sass(StylesPath + 'custom/index.scss', 'assets/css/custom.css',
        {implementation: require('node-sass'), sassOptions: {precision: 5}})
    .sass(StylesPath + 'vuesax/index.scss', 'assets/css/sax.css',
        {implementation: require('node-sass'), sassOptions: {precision: 5}})
    .sass(StylesPath + 'app.scss', 'assets/css',
        {implementation: require('node-sass'), sassOptions: {precision: 5}})
    .sass(StylesPath + 'web-app.scss', 'assets/css',
        {implementation: require('node-sass'), sassOptions: {precision: 5}})

    .options({
        processCssUrls: true,
        cssNano: {
            discardComments: {removeAll: true},
            discardDuplicates: isProduction,
            discardOverridden: isProduction,
            rawCache: isProduction
        },
        terser: {
            extractComments: false,
        },
        cleanCss: {
            all: false, // sets all values to `false`
            removeDuplicateRules: true // turns on removing duplicate rules
        }
    }).webpackConfig(webpack => {// Override webpack.config.js, without editing the file directly.
        let plugins = [new webpack.NormalModuleReplacementPlugin(/element-ui[\/\\]lib[\/\\]locale[\/\\]lang[\/\\]zh-CN/, 'element-ui/lib/locale/lang/nl')];

        if (isProduction) plugins = [
            new webpack.DefinePlugin({'process.env.NODE_ENV': JSON.stringify('production')}),
            new webpack.NormalModuleReplacementPlugin(/element-ui[\/\\]lib[\/\\]locale[\/\\]lang[\/\\]zh-CN/, 'element-ui/lib/locale/lang/nl'),
            new CompressionPlugin({
                cache: path.resolve(__dirname, 'public/.cache/'),
                algorithm: "gzip",
                filename: '[dir][name].gz[ext][query]'
            }), new OfflinePlugin({
                appCacheEnabled: true,
                responseStrategy: 'cache-first',
                updateStrategy: 'changed',
                caches: 'all',
                appShell: '/',
                externals: ['/', '/'],
                AppCache: {
                    events: true,
                    FALLBACK: { '/': '/' }
                },
                ServiceWorker: {
                    events: true
                }
            })
        ];

        return {
            mode: isProduction ? 'production' : 'development',
            plugins: plugins,
            resolve: {
                alias: {
                    vue$: isProduction ? 'vue/dist/vue.esm.js' : 'vue/dist/vue.runtime.esm.js',
                    GlobalComponents: path.resolve(__dirname, 'resources/assets/scripts/layout/components'),
                    Templates: path.resolve(__dirname, 'resources/assets/scripts/layout/templates'),
                    Hue: path.resolve(__dirname, 'resources/assets/scripts/pages/Hue'),
                    Core: path.resolve(__dirname, 'resources/assets/scripts/core'),
                    Sounds: path.resolve(__dirname, 'resources/assets/sounds'),
                }
            },
            optimization: {
                splitChunks: {
                    cacheGroups: {
                        svgGroup: {
                            test(module, chunks) {
                                // `module.resource` contains the absolute path of the file on disk.
                                // Note the usage of `path.sep` instead of / or \, for cross-platform compatibility.
                                const path = require('path');
                                return module.resource &&
                                    module.resource.endsWith('.svg') &&
                                    module.resource.includes(`${path.sep}cacheable_svgs${path.sep}`);
                            }
                        },
                        byModuleTypeGroup: {
                            chunks: 'all',
                            test(module, chunks) {
                                return module.type === 'javascript/vue/auto';
                            }
                        }
                    }
                }
            },
            module: {
                rules: [
                    {
                     test: /\.js$/,
                     loader: 'babel-loader',
                     exclude: file => (/ node_modules/.test(file) && !/\.vue\.js/.test(file))
                    },
                    {
                        test: /\.mp3$/,
                        loader: 'file-loader',
                        options: {
                            name: '[name].[ext]',
                            outputPath: 'assets/sounds',
                            publicPath: 'assets/sounds',
                        }
                    }
                ]
            },
            output: {
                umdNamedDefine: true,
                publicPath: '/',
                path: path.resolve(__dirname, 'public/'),
                filename: 'assets/scripts/[name].js',
                chunkFilename: 'assets/scripts/[name].js'
            },
        };
    })
    .copy('resources/assets/manifest.json', PublicPath + 'assets/')
    .copyDirectory('resources/assets/img', PublicPath + 'assets/img')
    .sourceMaps(false);

if (!isProduction)
    mix.serve()
        .browserSync({                                                 // Run browser sync for hot reload
            proxy: process.env.APP_URL,
            localOnly: process.env.BS_LOCAL_ONLY,
            reloadDelay: Number(process.env.BS_RELOAD_DELAY)
        }).disableNotifications();

else mix.version()
        .copyDirectory('public', 'public_html');
