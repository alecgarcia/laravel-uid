<?php

namespace Alecgarcia\LaravelUid;

use Illuminate\Support\ServiceProvider;

class LaravelUidServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'alecgarcia');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'alecgarcia');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-uid.php', 'laravel-uid');

        // Register the service the package provides.
        $this->app->singleton('uid', function ($app) {
            return new Uid;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['uid'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-uid.php' => config_path('laravel-uid.php'),
        ], 'laravel-uid.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/alecgarcia'),
        ], 'laravel-uid.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/alecgarcia'),
        ], 'laravel-uid.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/alecgarcia'),
        ], 'laravel-uid.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
