<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Tests\Unit;

use AlizHarb\ThemerLuncher\Policies\ThemePolicy;
use Illuminate\Support\Facades\Config;

test('it allows viewAny by default if authorization is disabled', function () {
    Config::set('themer-luncher.authorization.enabled', false);

    $policy = new ThemePolicy;
    expect($policy->viewAny(null))->toBeTrue();
});

test('it respects config permissions', function () {
    Config::set('themer-luncher.authorization.enabled', true);
    Config::set('themer-luncher.authorization.permissions.viewAny', true);

    $policy = new ThemePolicy;
    expect($policy->viewAny(null))->toBeTrue();

    Config::set('themer-luncher.authorization.permissions.viewAny', false);
    expect($policy->viewAny(null))->toBeFalse();
});
