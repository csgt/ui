<?php
namespace Laravel\Ui\Presets;

use Illuminate\Support\Arr;

class AdminLTE extends Preset
{
    /**
     * Install the preset.
     *
     * @return void
     */
    public static function install()
    {
        static::ensureComponentDirectoryExists();
        static::updatePackages();
        static::updateWebpackConfiguration();
        static::updateSass();
        static::updateBootstrapping();
        static::removeNodeModules();
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        return [
            '@fortawesome/fontawesome-free'     => '^5.8',
            'admin-lte'                         => '3.2.0-rc',
            'datatables.net-bs4'                => '^1.10',
            'datatables.net-responsive-bs4'     => '^2.2',
            'datatables.net-responsive'         => '^2.2',
            'datatables.net'                    => '^1.10',
            'eonasdan-bootstrap-datetimepicker' => '^4.17',
            'resolve-url-loader'                => '^4.0.0',
            'sass-loader'                       => '^12.1.0',
            'sass'                              => '^1.20.1',
            'toastr'                            => '^2.1',
            'vue-bootstrap-datetimepicker'      => '^5.0',
            'vue-moment'                        => '^4.0',
            'vue-template-compiler'             => '^2.6.10',
            'vue'                               => '^2.5.17',
            'vue2-selectize'                    => '^1.1',
            "vue-loader"                        => "^15.9.7",
        ] + Arr::except($packages, [
            '@babel/preset-react',
            'react',
            'react-dom',
        ]);
    }

    /**
     * Update the Webpack configuration.
     *
     * @return void
     */
    protected static function updateWebpackConfiguration()
    {
        copy(__DIR__ . '/adminlte-stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    /**
     * Update the Sass files for the application.
     *
     * @return void
     */
    protected static function updateSass()
    {
        copy(__DIR__ . '/adminlte-stubs/_variables.scss', resource_path('sass/_variables.scss'));
        copy(__DIR__ . '/adminlte-stubs/app.scss', resource_path('sass/app.scss'));
    }

    /**
     * Update the bootstrapping files.
     *
     * @return void
     */
    protected static function updateBootstrapping()
    {
        copy(__DIR__ . '/adminlte-stubs/app.js', resource_path('js/app.js'));
        copy(__DIR__ . '/adminlte-stubs/bootstrap.js', resource_path('js/bootstrap.js'));
    }
}
