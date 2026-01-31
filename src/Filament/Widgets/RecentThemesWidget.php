<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Filament\Widgets;

use AlizHarb\ThemerLuncher\Models\Theme;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

/**
 * Widget displaying a list of recent themes.
 */
final class RecentThemesWidget extends BaseWidget
{
    /** @var int|null Determine the order of the widget on the dashboard */
    protected static ?int $sort = 2;

    /**
     * Get the polling interval for the widget.
     */
    protected function getPollingInterval(): ?string
    {
        return config('themer-luncher.widgets.polling_interval');
    }

    /**
     * Get the localized heading for the widget.
     */
    public function getHeading(): string
    {
        return (string) __('themer-luncher::themes.widgets.recent.heading');
    }

    /**
     * Configure the table for the widget.
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(Theme::query())
            ->columns([
                TextColumn::make('name')
                    ->label(__('themer-luncher::themes.fields.name.label'))
                    ->weight('bold'),
                TextColumn::make('version')
                    ->label(__('themer-luncher::themes.fields.version.label'))
                    ->badge()
                    ->color('info'),
                IconColumn::make('is_active')
                    ->label(__('themer-luncher::themes.fields.status.label'))
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('gray'),
                IconColumn::make('assets')
                    ->label(__('themer-luncher::themes.fields.assets.label'))
                    ->state(fn (Theme $record): array => [
                        'views' => $record->has_views,
                        'translations' => $record->has_translations,
                        'livewire' => $record->has_livewire,
                    ])
                    ->icons([
                        'heroicon-o-eye' => fn (mixed $state): bool => (bool) ($state['views'] ?? false),
                        'heroicon-o-language' => fn (mixed $state): bool => (bool) ($state['translations'] ?? false),
                        'heroicon-o-sparkles' => fn (mixed $state): bool => (bool) ($state['livewire'] ?? false),
                    ])
                    ->color('gray'),
            ])
            ->paginated(false);
    }
}
