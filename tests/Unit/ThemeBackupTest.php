<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Tests\Unit;

use AlizHarb\ThemerLuncher\Models\ThemeBackup;

test('it can retrieve backups for a theme', function () {
    // This will depend on the filesystem, but we can check if it returns a collection
    $backups = ThemeBackup::all();

    expect($backups)->toBeInstanceOf(\Illuminate\Database\Eloquent\Collection::class);
});

test('it has the correct Sushi schema', function () {
    $model = new ThemeBackup;

    expect($model->getRows())->toBeArray();
});
