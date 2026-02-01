<?php

use AlizHarb\ThemerLuncher\Filament\Widgets\RecentThemesWidget;
use AlizHarb\ThemerLuncher\Filament\Widgets\ThemeStatsOverviewWidget;

/*
 * Unit Tests for Theme Widgets
 *
 * Tests all available widgets.
 */
describe('Theme Widgets Unit Tests', function () {
    describe('ThemeStatsOverviewWidget', function () {
        it('can instantiate stats widget', function () {
            $widget = new ThemeStatsOverviewWidget();
            expect($widget)->toBeInstanceOf(ThemeStatsOverviewWidget::class);
        });

        it('has getStats method', function () {
            expect(method_exists(ThemeStatsOverviewWidget::class, 'getStats'))->toBeTrue();
        });

        it('can get stats array', function () {
            $widget = new ThemeStatsOverviewWidget();
            $reflection = new ReflectionMethod($widget, 'getStats');
            $reflection->setAccessible(true);

            $stats = $reflection->invoke($widget);

            expect($stats)->toBeArray()
                ->and(count($stats))->toBeGreaterThanOrEqual(1);
        });
    });

    describe('RecentThemesWidget', function () {
        it('can instantiate recent themes widget', function () {
            $widget = new RecentThemesWidget();
            expect($widget)->toBeInstanceOf(RecentThemesWidget::class);
        });

        it('has table method', function () {
            expect(method_exists(RecentThemesWidget::class, 'table'))->toBeTrue();
        });

        it('validates widget extends base widget', function () {
            $reflection = new ReflectionClass(RecentThemesWidget::class);
            $parent = $reflection->getParentClass();

            expect($parent)->not->toBeFalse()
                ->and($parent->getName())->toContain('Widget');
        });
    });

    it('validates all widgets have proper configuration', function () {
        $widgets = [
            ThemeStatsOverviewWidget::class,
            RecentThemesWidget::class,
        ];

        foreach ($widgets as $widgetClass) {
            $reflection = new ReflectionClass($widgetClass);
            expect($reflection->isFinal())->toBeTrue("Widget {$widgetClass} should be final");
        }
    });
});
