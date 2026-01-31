<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Tests;

use AlizHarb\Themer\ThemeServiceProvider;
use AlizHarb\ThemerLuncher\ThemerLuncherServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Schemas\SchemasServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

/**
 * Base test case for the Themer Luncher package.
 */
abstract class TestCase extends Orchestra
{
    /**
     * Set up the test environment.
     */
    protected function setUp(): void
    {
        $themesPath = __DIR__.'/../themes';
        if (!file_exists($themesPath)) {
            mkdir($themesPath, 0755, true);
        }

        // Create a mock theme for testing
        $mockThemePath = $themesPath.'/TestTheme';
        if (!file_exists($mockThemePath)) {
            mkdir($mockThemePath, 0755, true);
        }
        file_put_contents($mockThemePath.'/theme.json', json_encode([
            'name' => 'TestTheme',
            'slug' => 'test-theme',
            'version' => '1.0.0',
            'description' => 'A test theme',
            'author' => 'Test Author',
        ]));

        parent::setUp();

        // Ensure no cache file interferes
        $cachePath = app()->bootstrapPath('cache/themes.php');
        if (file_exists($cachePath)) {
            unlink($cachePath);
        }

        // Reset and rescan to ensure the mock theme is discovered correctly
        /** @var \AlizHarb\Themer\ThemeManager $manager */
        $manager = app(\AlizHarb\Themer\ThemeManager::class);
        if (method_exists($manager, 'reset')) {
            $manager->reset();
        }
        $manager->scan($themesPath);
    }

    /**
     * Get the package providers.
     */
    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            SupportServiceProvider::class,
            FormsServiceProvider::class,
            TablesServiceProvider::class,
            InfolistsServiceProvider::class,
            SchemasServiceProvider::class,
            ActionsServiceProvider::class,
            NotificationsServiceProvider::class,
            WidgetsServiceProvider::class,
            FilamentServiceProvider::class,
            ThemeServiceProvider::class,
            ThemerLuncherServiceProvider::class,
            \BladeUI\Icons\BladeIconsServiceProvider::class,
            \BladeUI\Heroicons\BladeHeroiconsServiceProvider::class,
            \Spatie\LaravelData\LaravelDataServiceProvider::class,
        ];
    }

    /**
     * Define the environment.
     */
    protected function defineEnvironment($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('themer.themes_path', __DIR__.'/../themes');
        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));

        $app['config']->set('session.driver', 'array');

        $app['config']->set('themer-luncher.backups.storage_path', 'testing-backups');
        $app['config']->set('themer.themes_path', __DIR__.'/../themes');
        $app['config']->set('themer-luncher.backups.enabled', true);

        // Add session middleware for Livewire/Filament tests
        $app['router']->aliasMiddleware('session', \Illuminate\Session\Middleware\StartSession::class);
        $app['router']->pushMiddlewareToGroup('web', \Illuminate\Session\Middleware\StartSession::class);

        $app->booting(function () {
            \Filament\Facades\Filament::registerPanel(
                \Filament\Panel::make()
                    ->id('admin')
                    ->default()
                    ->path('admin')
            );
        });
    }
}
