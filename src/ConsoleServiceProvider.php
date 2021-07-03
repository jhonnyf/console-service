<?php

namespace SenventhCode\ConsoleService;

use Illuminate\Support\ServiceProvider;
use SenventhCode\ConsoleService\App\View\Components\Breadcrumb;
use SenventhCode\ConsoleService\App\View\Components\FormFields;
use SenventhCode\ConsoleService\App\View\Components\Nav;
use SenventhCode\ConsoleService\App\View\Components\TableFields;

class ConsoleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Routes
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'console-service');

        // Migrations
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

        // Components
        $this->loadViewComponentsAs('console-service', [
            Breadcrumb::class,
            TableFields::class,
            Nav::class,
            FormFields::class
        ]);        

        // Publishes
        $this->publishes([
            __DIR__ . '/public'          => public_path('console-service'),
            __DIR__ . '/resources/fonts' => public_path('console-service/../fonts'),
        ], 'public');        

        $this->publishes([
            __DIR__ . '/database/seeders' => database_path('migrations/../seeders'),
            __DIR__ . '/App/Models'       => database_path('migrations/../../App/Models'),
        ], 'migrations');

    }

    public function register()
    {

    }
}
