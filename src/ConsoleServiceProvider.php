<?php

namespace SenventhCode\ConsoleService;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Configuration

        // Migrations

        // Routes
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Translations

        // Views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'console-service');

        // View Components

        // Publishes
        $this->publishes([
            __DIR__ . '/public' => public_path('console-service'),
        ], 'public');
    }

    public function register()
    {

    }
}
