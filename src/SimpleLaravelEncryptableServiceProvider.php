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

}
