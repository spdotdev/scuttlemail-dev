<?php

namespace Spdotdev\ScuttlemailDev;

use Illuminate\Support\ServiceProvider;

class ScuttlemailDevServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/scuttlemail-dev.php', 'scuttlemail-dev');
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'scuttlemail');

        $this->publishes([
            __DIR__.'/../config/scuttlemail-dev.php' => config_path('scuttlemail-dev.php'),
        ], 'scuttlemail-dev-config');
    }
}
