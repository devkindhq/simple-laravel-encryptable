<?php

namespace Devkind\SimpleLaravelEncryptable;

use Illuminate\Support\ServiceProvider;

class SimpleLaravelEncryptableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('simple-encryptable.php'),
            ], 'config');

        }
    }


    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'simple-encryptable');

        // Register the main class to use with the facade
        $this->app->singleton('simple-encryptable', function () {
            return new SimpleEncryptable;
        });
    }

}
