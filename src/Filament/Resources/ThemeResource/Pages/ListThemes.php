<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\Pages;

use AlizHarb\Themer\Facades\Theme as ThemerFacade;
use AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource;
use AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\Tables\ThemeTable;
use AlizHarb\ThemerLuncher\Filament\Widgets\RecentThemesWidget;
use AlizHarb\ThemerLuncher\Filament\Widgets\ThemeStatsOverviewWidget;
use AlizHarb\ThemerLuncher\Models\Theme;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

/**
 * Page class for listing and managing themes.
 */
class ListThemes extends ListRecords
{
    /** @var string The resource associated with the page */
    protected static string $resource = ThemeResource::class;

    /**
     * Get the header actions for the page.
     *
     * @return array<int, \Filament\Actions\Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            ThemeTable::installAction(),
            ThemeTable::clearCacheAction(),
        ];
    }

    /**
     * Get the header widgets for the page.
     *
     * @return array<int, class-string>
     */
    protected function getHeaderWidgets(): array
    {
        $widgets = [];

        if (config('themer-luncher.widgets.enabled', true) &&
            config('themer-luncher.widgets.display_on.table', true) &&
            config('themer-luncher.widgets.display.stats', true)) {
            $widgets[] = ThemeStatsOverviewWidget::class;
        }

        return $widgets;
    }

    /**
     * Get the footer widgets for the page.
     *
     * @return array<int, class-string>
     */
    protected function getFooterWidgets(): array
    {
        $widgets = [];

        if (config('themer-luncher.widgets.enabled', true) &&
            config('themer-luncher.widgets.display_on.table', true) &&
            config('themer-luncher.widgets.display.recent', true)) {
            $widgets[] = RecentThemesWidget::class;
        }

        return $widgets;
    }

    /**
     * Get the tabbed navigation for filtering records.
     *
     * @return array<string, Tab>
     */
    public function getTabs(): array
    {
        $themes = Theme::all();
        $activeTheme = ThemerFacade::getActiveTheme();

        return [
            'all' => Tab::make(__('themer-luncher::themes.resource.plural_label'))
                ->icon('heroicon-m-list-bullet')
                ->badge($themes->count()),
            'active' => Tab::make(__('themer-luncher::themes.options.active'))
                ->icon('heroicon-m-check-circle')
                ->badge($activeTheme ? 1 : 0)
                ->badgeColor('success')
                ->modifyQueryUsing(fn ($query) => $query->where('name', $activeTheme?->name)),
            'child' => Tab::make(__('themer-luncher::themes.filters.has_parent'))
                ->icon('heroicon-m-link')
                ->badge($themes->whereNotNull('parent')->count())
                ->badgeColor('info')
                ->modifyQueryUsing(fn ($query) => $query->whereNotNull('parent')),
        ];
    }
}
