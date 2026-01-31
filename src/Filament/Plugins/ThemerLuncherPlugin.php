<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Filament\Plugins;

use AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource;
use AlizHarb\ThemerLuncher\Filament\Widgets\RecentThemesWidget;
use AlizHarb\ThemerLuncher\Filament\Widgets\ThemeStatsOverviewWidget;
use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use UnitEnum;

/**
 * Filament plugin for theme management.
 */
class ThemerLuncherPlugin implements Plugin
{
    use EvaluatesClosures;

    /**
     * The ID of the plugin.
     */
    public static string $name = 'themer-luncher';

    /**
     * The label for the theme resource.
     */
    protected string|Closure|null $label = null;

    /**
     * The plural label for the theme resource.
     */
    protected string|Closure|null $pluralLabel = null;

    /**
     * The navigation group for the theme resource.
     */
    protected string|Closure|null|UnitEnum $navigationGroup = null;

    /**
     * The navigation icon for the theme resource.
     */
    protected string|Closure|null $navigationIcon = null;

    /**
     * The navigation sort order for the theme resource.
     */
    protected int|Closure|null $navigationSort = null;

    /**
     * The navigation count badge for the theme resource.
     */
    protected string|Closure|null $navigationCountBadge = null;

    /**
     * Get the plugin ID.
     */
    public function getId(): string
    {
        return static::$name;
    }

    /**
     * Create a new plugin instance.
     */
    public static function make(): static
    {
        return app(static::class);
    }

    /**
     * Get the plugin instance from the Filament panel.
     */
    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    /**
     * Register the plugin with the panel.
     */
    public function register(Panel $panel): void
    {
        $panel->resources([
            config('themer-luncher.resource.class', ThemeResource::class),
        ]);

        if (config('themer-luncher.widgets.enabled', true) &&
            config('themer-luncher.widgets.display_on.dashboard', true)) {
            $widgets = [];

            if (config('themer-luncher.widgets.display.stats', true)) {
                $widgets[] = ThemeStatsOverviewWidget::class;
            }

            if (config('themer-luncher.widgets.display.recent', true)) {
                $widgets[] = RecentThemesWidget::class;
            }

            if (!empty($widgets)) {
                $panel->widgets($widgets);
            }
        }
    }

    /**
     * Bootstrap the plugin.
     */
    public function boot(Panel $panel): void
    {
        //
    }

    /**
     * Set the label for the theme resource.
     */
    public function label(string|Closure|null $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get the evaluated label.
     */
    public function getLabel(): string
    {
        return $this->evaluate($this->label) ?? __('themer-luncher::themes.resource.label');
    }

    /**
     * Set the plural label for the theme resource.
     */
    public function pluralLabel(string|Closure|null $label): static
    {
        $this->pluralLabel = $label;

        return $this;
    }

    /**
     * Get the evaluated plural label.
     */
    public function getPluralLabel(): string
    {
        return $this->evaluate($this->pluralLabel) ?? __('themer-luncher::themes.resource.plural_label');
    }

    /**
     * Set the navigation group for the theme resource.
     */
    public function navigationGroup(string|Closure|null|UnitEnum $group): static
    {
        $this->navigationGroup = $group;

        return $this;
    }

    /**
     * Get the evaluated navigation group.
     */
    public function getNavigationGroup(): UnitEnum|string|null
    {
        return $this->evaluate($this->navigationGroup) ?? config('themer-luncher.resource.navigation_group');
    }

    /**
     * Set the navigation icon for the theme resource.
     */
    public function navigationIcon(string|Closure|null $icon): static
    {
        $this->navigationIcon = $icon;

        return $this;
    }

    /**
     * Get the evaluated navigation icon.
     */
    public function getNavigationIcon(): ?string
    {
        return $this->evaluate($this->navigationIcon) ?? config('themer-luncher.resource.navigation_icon');
    }

    /**
     * Set the navigation sort order for the theme resource.
     */
    public function navigationSort(int|Closure|null $sort): static
    {
        $this->navigationSort = $sort;

        return $this;
    }

    /**
     * Get the evaluated navigation sort order.
     */
    public function getNavigationSort(): ?int
    {
        return $this->evaluate($this->navigationSort) ?? config('themer-luncher.resource.navigation_sort');
    }

    /**
     * Set the navigation count badge for the theme resource.
     */
    public function navigationCountBadge(string|Closure|null $badge): static
    {
        $this->navigationCountBadge = $badge;

        return $this;
    }

    /**
     * Get the evaluated navigation count badge.
     */
    public function getNavigationCountBadge(): ?string
    {
        return $this->evaluate($this->navigationCountBadge);
    }
}
