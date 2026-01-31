<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Tests\Feature;

use AlizHarb\ThemerLuncher\Services\ThemeService;
use Illuminate\Support\Facades\File;

test('it can handle a full theme lifecycle flow', function () {
    $service = app(ThemeService::class);
    $themeName = 'TestTheme';

    // 1. Activation
    $service->activate($themeName);
    expect(\AlizHarb\Themer\Facades\Theme::getActiveTheme()?->name)->toBe('TestTheme'); // Name is "TestTheme" from TestCase setup

    // 2. Backup
    $backup = $service->backup($themeName);
    $backupPath = storage_path('app/'.config('themer-luncher.backups.storage_path').'/'.$backup->filename);
    expect(File::exists($backupPath))->toBeTrue();

    // 3. Asset Publishing
    $service->publishAssets($themeName);
    // Assuming we can check if a symlink exists in public, but that might depend on root access or local environment
    // For now, we trust the service call if no error occurs

    // 4. Restoration
    $service->restore($themeName, $backup->filename);
    expect(File::exists($backupPath))->toBeTrue(); // Backup should still exist

    // 5. Deletion (Cleanup)
    // To delete, it must not be active
    $service->activate(''); // Deactivate
    $service->delete($themeName);

    $expectedPath = config('themer.themes_path').'/'.$themeName;
    expect(File::exists($expectedPath))->toBeFalse();
});
