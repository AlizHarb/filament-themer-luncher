<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Tests\Feature;

use AlizHarb\Themer\Facades\Theme as ThemeFacade;
use AlizHarb\ThemerLuncher\Http\Middleware\SetPreviewTheme;
use AlizHarb\ThemerLuncher\Services\ThemeService;
use Illuminate\Http\Request;

test('it can set preview theme from session', function () {
    $themeName = 'TestTheme';
    session(['preview_theme' => $themeName]);

    $middleware = new SetPreviewTheme();
    $request = Request::create('/', 'GET');
    $request->setLaravelSession(app('session.store'));

    $middleware->handle($request, function ($req) use ($themeName) {
        expect(ThemeFacade::getActiveTheme()?->name)->toBe($themeName);

        return response('OK');
    });
});

test('it can set preview theme from query string', function () {
    $themeName = 'TestTheme';

    $middleware = new SetPreviewTheme();
    $request = Request::create('/', 'GET', ['preview_theme' => $themeName]);
    $request->setLaravelSession(app('session.store'));

    $middleware->handle($request, function ($req) use ($themeName) {
        expect(ThemeFacade::getActiveTheme()?->name)->toBe($themeName);

        return response('OK');
    });
});

test('it forgets preview theme if theme does not exist', function () {
    $themeName = 'NonExistentTheme';
    session(['preview_theme' => $themeName]);

    $middleware = new SetPreviewTheme();
    $request = Request::create('/', 'GET');
    $request->setLaravelSession(app('session.store'));

    $middleware->handle($request, function ($req) {
        return response('OK');
    });

    expect(session()->has('preview_theme'))->toBeFalse();
});

test('ThemeService can start a preview', function () {
    $service = app(ThemeService::class);
    $themeName = 'TestTheme';

    $service->preview($themeName);

    expect(session('preview_theme'))->toBe($themeName);
});
