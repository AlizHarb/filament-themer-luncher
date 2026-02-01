<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Tests\Unit;

use AlizHarb\ThemerLuncher\Models\Theme;

test('it can retrieve all themes', function () {
    $themes = Theme::all();
    echo 'Found themes count: '.$themes->count()."\n";

    expect($themes)->not->toBeEmpty()
        ->and($themes->first())->toBeInstanceOf(Theme::class);
});

test('it correctly identifies the active theme', function () {
    $theme = Theme::first();

    expect($theme->is_active)->toBeBool();
});

test('it has the expected schema', function () {
    $theme = new Theme();

    expect($theme->getRows())->toBeArray();
});
