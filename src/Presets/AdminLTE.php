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
        static::updateViteConfiguration();
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
            'resolve-url-loader'            => '^5.0.0',
            'sass'                          => '^1.20.1',
            'sass-loader'                   => '^16.0.7',
            'vue'                           => '^3.0',
            'vue-template-compiler'         => '^2.6.10',
            '@fortawesome/fontawesome-free' => '^7.2.0',
            'admin-lte'                     => '4.0.0-rc7',
            'datatables.net'                => '^2.0',
            'datatables.net-bs4'            => '^2.0',
            'datatables.net-responsive'     => '^3.0',
            'datatables.net-responsive-bs5' => '^3.0',
            'toastr'                        => '^2.1',
            'vue-moment'                    => '^4.0',
            'vue2-selectize'                => '^1.1',
            "vue-multiselect"               => "^3.0.0-beta.3",
            "@vitejs/plugin-vue"            => "^6.0.5",
            "vite-plugin-static-copy"       => "^3.1.2",
        ] + Arr::except($packages, [
            '@babel/preset-react',
            'react',
            'react-dom',
            'tailwindcss',
            'tailwindcss/vite'
        ]);
    }

    /**
     * Update the Vite configuration.
     *
     * @return void
     */
    protected static function updateViteConfiguration()
    {
        copy(__DIR__ . '/adminlte-stubs/vite.config.js', base_path('vite.config.js'));
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
