<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Tests\Feature;

use AlizHarb\ThemerLuncher\Models\Theme;

test('it can discover installed themes', function () {
    // The TestCase creates a 'TestTheme' in the themes path
    $themes = Theme::all();

    expect($themes->pluck('name'))->toContain('TestTheme');
});

test('it can detect theme features', function () {
    $theme = Theme::where('name', 'TestTheme')->first();

    expect($theme)->not->toBeNull()
        ->and($theme->slug)->toBe('test-theme');
});
