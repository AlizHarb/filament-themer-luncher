<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Filament\Widgets;

use AlizHarb\Themer\Facades\Theme as ThemerFacade;
use AlizHarb\ThemerLuncher\Models\Theme;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

/**
 * Overview statistics widget for the themer system.
 */
final class ThemeStatsOverviewWidget extends BaseWidget
{
    /** @var int|null Determine the order of the widget on the dashboard */
    protected static ?int $sort = 1;

    /**
     * Get the polling interval for the widget.
     */
    protected function getPollingInterval(): ?string
    {
        return config('themer-luncher.widgets.polling_interval');
    }

    /**
     * Get the statistical data points for the widget.
     *
     * @return array<int, Stat>
     */
    protected function getStats(): array
    {
        $themes = Theme::all();
        $total = $themes->count();
        $activeTheme = ThemerFacade::getActiveTheme();
        $withParent = $themes->whereNotNull('parent')->count();

        return [
            Stat::make(__('themer-luncher::themes.widgets.stats.total.label'), $total)
                ->description(__('themer-luncher::themes.widgets.stats.total.description'))
                ->descriptionIcon('heroicon-o-paint-brush')
                ->color('primary'),

            Stat::make(__('themer-luncher::themes.widgets.stats.active.label'), $activeTheme ? $activeTheme->name : __('themer-luncher::themes.options.none'))
                ->description(__('themer-luncher::themes.widgets.stats.active.description'))
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make(__('themer-luncher::themes.widgets.stats.parents.label'), $withParent)
                ->description(__('themer-luncher::themes.widgets.stats.parents.description'))
                ->descriptionIcon('heroicon-o-link')
                ->color('info'),
        ];
    }
}
