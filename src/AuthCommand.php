<?php
namespace Laravel\Ui;

use InvalidArgumentException;
use Illuminate\Console\Command;

class AuthCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ui:auth
                    { type=bootstrap : The preset type (bootstrap) }
                    {--views : Only scaffold the authentication views}
                    {--force : Overwrite existing views by default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic login and registration views and routes';

    /**
     * The views that need to be exported.
     *
     * @var array
     */
    protected $views = [
        'auth/login.stub'             => 'auth/login.blade.php',
        'auth/passwords/confirm.stub' => 'auth/passwords/confirm.blade.php',
        'auth/passwords/email.stub'   => 'auth/passwords/email.blade.php',
        'auth/passwords/reset.stub'   => 'auth/passwords/reset.blade.php',
        'auth/register.stub'          => 'auth/register.blade.php',
        'auth/verify.stub'            => 'auth/verify.blade.php',
        'home.stub'                   => 'home.blade.php',
        'layouts/app.stub'            => 'layouts/app.blade.php',
        'component.stub'              => 'component.blade.php',
    ];

    protected $trans = [
        'es/auth.stub'       => 'es/auth.php',
        'es/login.stub'      => 'es/login.php',
        'es/pagination.stub' => 'es/pagination.php',
        'es/passwords.stub'  => 'es/passwords.php',
        'es/validation.stub' => 'es/validation.php',
        'es.json'            => 'es.json',
    ];

    protected $seeders = [
        'DatabaseSeeder.stub'          => 'DatabaseSeeder.php',
        'GodSeeder.stub'               => 'GodSeeder.php',
        'InitialSeeder.stub'           => 'InitialSeeder.php',
        'MenuSeeder.stub'              => 'MenuSeeder.php',
        'ModulePermissionsSeeder.stub' => 'ModulePermissionsSeeder.php',
        'ModulesSeeder.stub'           => 'ModulesSeeder.php',
        'PermissionsSeeder.stub'       => 'PermissionsSeeder.php',
        'Sections.stub'                => 'Sections.php',
    ];

    /**
     * Execute the console command.
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function handle()
    {
        if (static::hasMacro($this->argument('type'))) {
            return call_user_func(static::$macros[$this->argument('type')], $this);
        }

        if (!in_array($this->argument('type'), ['bootstrap'])) {
            throw new InvalidArgumentException('Invalid preset.');
        }

        $this->ensureDirectoriesExist();
        $this->exportViews();
        $this->exportLangs();
        $this->exportSeeders();

        if (!$this->option('views')) {
            $this->exportBackend();
        }

        $this->info('Authentication scaffolding generated successfully.');
    }

    /**
     * Create the directories for the files.
     *
     * @return void
     */
    protected function ensureDirectoriesExist()
    {
        if (!is_dir($directory = $this->getViewPath('layouts'))) {
            mkdir($directory, 0755, true);
        }

        if (!is_dir($directory = $this->getViewPath('auth/passwords'))) {
            mkdir($directory, 0755, true);
        }

        if (!is_dir($directory = app_path('Http/Controllers/Catalogs'))) {
            mkdir($directory, 0755, true);
        }

        if (!is_dir($directory = resource_path('lang/es'))) {
            mkdir($directory, 0755, true);
        }
    }

    /**
     * Export the authentication views.
     *
     * @return void
     */
    protected function exportViews()
    {
        foreach ($this->views as $key => $value) {
            if (file_exists($view = $this->getViewPath($value)) && !$this->option('force')) {
                if (!$this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                __DIR__ . '/Auth/' . $this->argument('type') . '-stubs/' . $key,
                $view
            );
        }
    }

    /**
     * Export the authentication langs.
     *
     * @return void
     */
    protected function exportLangs()
    {
        foreach ($this->trans as $key => $value) {
            if (file_exists($lang = resource_path('lang/' . $value)) && !$this->option('force')) {
                if (!$this->confirm("The [{$value}] lang already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                __DIR__ . '/Auth/stubs/langs/' . $key,
                $lang
            );
        }
    }

    /**
     * Export the authentication seeders
     *
     * @return void
     */
    protected function exportSeeders()
    {
        foreach ($this->seeders as $key => $value) {
            if (file_exists($seed = database_path('seeders/' . $value)) && !$this->option('force')) {
                if (!$this->confirm("The [{$value}] seeder already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                __DIR__ . '/Auth/stubs/seeders/' . $key,
                $seed
            );
        }
    }

    /**
     * Export the authentication backend.
     *
     * @return void
     */
    protected function exportBackend()
    {
        $this->callSilent('ui:controllers');

        $stubs = [
            'HomeController',
            'Catalogs/RolesController',
            'Catalogs/UsersController',
            'ProfileController',
        ];

        foreach ($stubs as $stub) {
            $controller = app_path('Http/Controllers/' . $stub . '.php');

            if (file_exists($controller) && !$this->option('force')) {
                if ($this->confirm("The [" . $stub . ".php] file already exists. Do you want to replace it?")) {
                    file_put_contents($controller, $this->compileControllerStub($stub . '.stub'));
                }
            } else {
                file_put_contents($controller, $this->compileControllerStub($stub . '.stub'));
            }
        }

        copy(
            __DIR__ . '/Auth/stubs/routes.stub',
            base_path('routes/web.php'),
        );

        copy(
            __DIR__ . '/../stubs/migrations/2014_10_12_100000_create_password_resets_table.php',
            base_path('database/migrations/2014_10_12_100000_create_password_resets_table.php')
        );
    }

    /**
     * Compiles the "HomeController" stub.
     *
     * @return string
     */
    protected function compileControllerStub($path)
    {
        return str_replace(
            '{{namespace}}',
            $this->laravel->getNamespace(),
            file_get_contents(__DIR__ . '/Auth/stubs/controllers/' . $path)
        );
    }

    /**
     * Get full view path relative to the application's configured view path.
     *
     * @param  string  $path
     * @return string
     */
    protected function getViewPath($path)
    {
        return implode(DIRECTORY_SEPARATOR, [
            config('view.paths')[0] ?? resource_path('views'), $path,
        ]);
    }
}
