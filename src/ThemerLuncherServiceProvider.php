<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher;

use AlizHarb\ThemerLuncher\Services\ThemeService;
use Illuminate\Support\ServiceProvider;

/**
 * Service provider for the Filament Themer Luncher package.
 *
 * Responsible for registering services, merging configuration,
 * and bootstrapping package resources like translations.
 */
final class ThemerLuncherServiceProvider extends ServiceProvider
{
    /**
     * Register the package services and merge configuration.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/themer-luncher.php', 'themer-luncher');

        $this->app->singleton(ThemeService::class, fn (): ThemeService => new ThemeService());
    }

    /**
     * Bootstrap the package resources.
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'themer-luncher');

        app('router')->pushMiddlewareToGroup('web', \AlizHarb\ThemerLuncher\Http\Middleware\SetPreviewTheme::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/themer-luncher.php' => config_path('themer-luncher.php'),
            ], 'themer-luncher-config');

            $this->publishes([
                __DIR__.'/../lang' => lang_path('vendor/themer-luncher'),
            ], 'themer-luncher-translations');
        }
    }
}
