<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\Tables;

use AlizHarb\Themer\Facades\Theme as ThemerFacade;
use AlizHarb\ThemerLuncher\Data\InstallThemeData;
use AlizHarb\ThemerLuncher\Exceptions\ThemeInstallationException;
use AlizHarb\ThemerLuncher\Exceptions\ThemeOperationException;
use AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource;
use AlizHarb\ThemerLuncher\Models\Theme;
use AlizHarb\ThemerLuncher\Services\ThemeService;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Static schema configuration for the theme management table.
 */
final class ThemeTable
{
    /**
     * Configure the provided Filament table with columns, actions, and filters.
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(self::getColumns())
            ->recordActions(self::getRecordActions())
            ->headerActions(self::getHeaderActions())
            ->filters(self::getFilters())
            ->filtersFormColumns(2)
            ->toolbarActions(self::getBulkActions());
    }

    /**
     * Get the column definitions for the theme table.
     *
     * @return array<int, \Filament\Tables\Columns\Column>
     */
    protected static function getColumns(): array
    {
        return [
            ImageColumn::make('screenshot_url')
                ->label(__('themer-luncher::themes.fields.screenshot.label'))
                ->circular()
                ->disk('public')
                ->visibility('public')
                ->toggleable(),

            TextColumn::make('name')
                ->label(__('themer-luncher::themes.fields.name.label'))
                ->searchable()
                ->sortable()
                ->weight('bold'),

            TextColumn::make('version')
                ->label(__('themer-luncher::themes.fields.version.label'))
                ->badge()
                ->color('info'),

            IconColumn::make('is_active')
                ->label(__('themer-luncher::themes.fields.status.label'))
                ->boolean()
                ->trueColor('success')
                ->falseColor('gray')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle'),

            TextColumn::make('parent')
                ->label(__('themer-luncher::themes.fields.parent.label'))
                ->description(fn (Theme $record): ?string => $record->parent_theme?->name)
                ->toggleable(),

            TextColumn::make('authors')
                ->label(__('themer-luncher::themes.fields.authors.label'))
                ->formatStateUsing(function (mixed $state): string {
                    return collect((array) $state)
                        ->map(function (mixed $author): ?string {
                            if (is_array($author)) {
                                return $author['name'] ?? null;
                            }

                            return is_string($author) ? $author : null;
                        })
                        ->filter()
                        ->join(', ');
                })
                ->tooltip(function (Theme $record): string {
                    return collect($record->authors)
                        ->map(function (array $author): string {
                            $name = $author['name'];
                            $email = $author['email'] ?? null;

                            return $name.($email ? " <{$email}>" : '');
                        })
                        ->join("\n");
                })
                ->default(__('themer-luncher::themes.errors.unknown_author'))
                ->limit(30)
                ->toggleable(),

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
                ->color('gray')
                ->tooltip(fn (mixed $state): string => collect((array) $state)->filter()->keys()->join(', '))
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    /**
     * Get the actions available for each theme record.
     *
     * @return array<int, ActionGroup>
     */
    protected static function getRecordActions(): array
    {
        return [
            ActionGroup::make([
                self::activateAction(),
                self::previewAction(),
                self::viewAction(),
                self::backupAction(),
                self::restoreAction(),
                self::publishAssetsAction(),
                self::deleteAction(),
            ])->icon('heroicon-m-ellipsis-vertical'),
        ];
    }

    /**
     * Get the header actions for the table.
     *
     * @return array<int, Action>
     */
    protected static function getHeaderActions(): array
    {
        return [
            self::installAction(),
            self::clearCacheAction(),
        ];
    }

    /**
     * Create the theme activation action.
     */
    public static function activateAction(): Action
    {
        return Action::make('activate')
            ->label(__('themer-luncher::themes.actions.activate.label'))
            ->icon('heroicon-o-check-badge')
            ->color('success')
            ->hidden(fn (Theme $record): bool => $record->is_active)
            ->action(function (Theme $record, ThemeService $service): void {
                try {
                    $service->activate($record->name);
                    Notification::make()
                        ->title(__('themer-luncher::themes.notifications.activated'))
                        ->success()
                        ->send();
                } catch (ThemeOperationException $e) {
                    Notification::make()
                        ->title(__('themer-luncher::themes.errors.unexpected_error'))
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            });
    }

    /**
     * Create the theme preview action.
     */
    public static function previewAction(): Action
    {
        return Action::make('preview')
            ->label(__('themer-luncher::themes.actions.preview.label'))
            ->icon('heroicon-o-presentation-chart-bar')
            ->color('info')
            ->url(fn (Theme $record): string => url("/?preview_theme={$record->slug}"))
            ->openUrlInNewTab();
    }

    /**
     * Create the view theme details action.
     */
    protected static function viewAction(): Action
    {
        return Action::make('view')
            ->label(__('themer-luncher::themes.actions.view.label'))
            ->icon('heroicon-o-eye')
            ->url(fn (Theme $record): string => ThemeResource::getUrl('view', ['record' => $record->name]));
    }

    /**
     * Create the theme backup action.
     */
    protected static function backupAction(): Action
    {
        return Action::make('backup')
            ->label(__('themer-luncher::themes.actions.backup.label'))
            ->icon('heroicon-o-archive-box')
            ->color('gray')
            ->action(function (Theme $record, ThemeService $service): void {
                try {
                    $service->backup($record->name);
                    Notification::make()
                        ->title(__('themer-luncher::themes.notifications.backed_up'))
                        ->success()
                        ->send();
                } catch (ThemeOperationException $e) {
                    Notification::make()
                        ->title(__('themer-luncher::themes.errors.unexpected_error'))
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            })
            ->visible(fn (): bool => (bool) config('themer-luncher.backups.enabled', true));
    }

    /**
     * Create the theme restore action.
     */
    protected static function restoreAction(): Action
    {
        return Action::make('restore')
            ->label(__('themer-luncher::themes.actions.restore.label'))
            ->icon('heroicon-o-arrow-path')
            ->color('warning')
            ->requiresConfirmation()
            ->action(function (Theme $record, ThemeService $service): void {
                try {
                    $service->restore($record->name);
                    Notification::make()
                        ->title(__('themer-luncher::themes.notifications.restored'))
                        ->success()
                        ->send();
                } catch (ThemeOperationException $e) {
                    Notification::make()
                        ->title(__('themer-luncher::themes.errors.unexpected_error'))
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            })
            ->visible(fn (): bool => (bool) config('themer-luncher.backups.enabled', true));
    }

    /**
     * Create the publish assets action.
     */
    protected static function publishAssetsAction(): Action
    {
        return Action::make('publishAssets')
            ->label(__('themer-luncher::themes.actions.publish_assets.label'))
            ->icon('heroicon-o-arrow-up-tray')
            ->color('info')
            ->action(function (Theme $record, ThemeService $service): void {
                try {
                    $service->publishAssets($record->name);
                    Notification::make()
                        ->title(__('themer-luncher::themes.notifications.assets_published'))
                        ->success()
                        ->send();
                } catch (Exception $e) {
                    Notification::make()
                        ->title(__('themer-luncher::themes.errors.unexpected_error'))
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            });
    }

    /**
     * Create the theme deletion action.
     */
    protected static function deleteAction(): Action
    {
        return Action::make('delete')
            ->label(__('themer-luncher::themes.actions.delete.label'))
            ->icon('heroicon-o-trash')
            ->color('danger')
            ->requiresConfirmation()
            ->hidden(fn (Theme $record): bool => ! $record->is_removeable)
            ->action(function (Theme $record, ThemeService $service): void {
                try {
                    $service->delete($record->name);
                    Notification::make()
                        ->title(__('themer-luncher::themes.notifications.deleted'))
                        ->success()
                        ->send();
                } catch (ThemeOperationException $e) {
                    Notification::make()
                        ->title(__('themer-luncher::themes.errors.unexpected_error'))
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            });
    }

    /**
     * Create the theme installation action.
     */
    public static function installAction(): Action
    {
        return Action::make('install')
            ->label(__('themer-luncher::themes.actions.install.label'))
            ->icon('heroicon-o-plus-circle')
            ->color('success')
            ->schema([
                Select::make('source_type')
                    ->label(__('themer-luncher::themes.fields.source_type.label'))
                    ->options([
                        'zip' => __('themer-luncher::themes.options.sources.zip'),
                        'url' => __('themer-luncher::themes.options.sources.url'),
                        'git' => __('themer-luncher::themes.options.sources.git'),
                        'local' => __('themer-luncher::themes.options.sources.local'),
                    ])
                    ->required()
                    ->live(),
                FileUpload::make('file_path')
                    ->label(__('themer-luncher::themes.fields.file.label'))
                    ->disk((string) config('themer-luncher.installation.disk', 'local'))
                    ->directory('themes/uploads')
                    ->acceptedFileTypes(['application/zip'])
                    ->visible(fn (callable $get): bool => $get('source_type') === 'zip')
                    ->required(fn (callable $get): bool => $get('source_type') === 'zip'),
                TextInput::make('url')
                    ->label(__('themer-luncher::themes.fields.url.label'))
                    ->url()
                    ->visible(fn (callable $get): bool => $get('source_type') === 'url')
                    ->required(fn (callable $get): bool => $get('source_type') === 'url'),
                TextInput::make('git_repo')
                    ->label(__('themer-luncher::themes.fields.git_repo.label'))
                    ->placeholder('https://github.com/user/theme-repo.git')
                    ->visible(fn (callable $get): bool => $get('source_type') === 'git')
                    ->required(fn (callable $get): bool => $get('source_type') === 'git'),
                TextInput::make('local_path')
                    ->label(__('themer-luncher::themes.fields.local_path.label'))
                    ->visible(fn (callable $get): bool => $get('source_type') === 'local')
                    ->required(fn (callable $get): bool => $get('source_type') === 'local'),
                Toggle::make('activate_after_install')
                    ->label(__('themer-luncher::themes.fields.activate_after_install.label'))
                    ->default(false),
            ])
            ->action(function (array $data, ThemeService $service): void {
                try {
                    if ($data['source_type'] === 'zip' && isset($data['file_path'])) {
                        $disk = (string) config('themer-luncher.installation.disk', 'local');
                        $data['file_path'] = Storage::disk($disk)->path((string) $data['file_path']);
                    }

                    $installData = InstallThemeData::from($data);
                    $service->install($installData);

                    Notification::make()
                        ->title(__('themer-luncher::themes.notifications.installed'))
                        ->success()
                        ->send();
                } catch (ThemeInstallationException $e) {
                    Notification::make()
                        ->title(__('themer-luncher::themes.errors.installation_failed'))
                        ->body($e->getMessage())
                        ->danger()
                        ->persistent()
                        ->send();
                } catch (Exception $e) {
                    Notification::make()
                        ->title(__('themer-luncher::themes.errors.unexpected_error'))
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            })
            ->visible(fn (): bool => (bool) config('themer-luncher.installation.enabled', true));
    }

    /**
     * Create the clear cache action.
     */
    public static function clearCacheAction(): Action
    {
        return Action::make('clearCache')
            ->label(__('themer-luncher::themes.actions.clear_cache.label'))
            ->icon('heroicon-o-trash')
            ->color('gray')
            ->action(function (ThemeService $service): void {
                $service->clearCache();
                Notification::make()
                    ->title(__('themer-luncher::themes.notifications.cache_cleared'))
                    ->success()
                    ->send();
            });
    }

    /**
     * Get the filter definitions for the table.
     *
     * @return array<int, \Filament\Tables\Filters\BaseFilter>
     */
    protected static function getFilters(): array
    {
        return [
            SelectFilter::make('is_active')
                ->label(__('themer-luncher::themes.filters.status.label'))
                ->options([
                    '1' => __('themer-luncher::themes.filters.status.active'),
                    '0' => __('themer-luncher::themes.filters.status.inactive'),
                ])
                ->placeholder(__('themer-luncher::themes.filters.status.all'))
                ->query(function (Builder $query, array $data): Builder {
                    if (($data['value'] ?? null) === null) {
                        return $query;
                    }

                    $isActive = (bool) $data['value'];
                    $activeTheme = ThemerFacade::getActiveTheme();

                    if ($isActive) {
                        return $query->where('name', $activeTheme?->name);
                    }

                    return $query->where('name', '!=', $activeTheme?->name);
                }),

            Filter::make('has_parent')
                ->label(__('themer-luncher::themes.filters.has_parent'))
                ->query(fn (Builder $query) => $query->whereNotNull('parent'))
                ->toggle(),

            Filter::make('has_views')
                ->label(__('themer-luncher::themes.filters.has_views'))
                ->query(fn (Builder $query) => $query->where('has_views', true))
                ->toggle(),

            Filter::make('has_livewire')
                ->label(__('themer-luncher::themes.filters.has_livewire'))
                ->query(fn (Builder $query) => $query->where('has_livewire', true))
                ->toggle(),

            Filter::make('has_translations')
                ->label(__('themer-luncher::themes.filters.has_translations'))
                ->query(fn (Builder $query) => $query->where('has_translations', true))
                ->toggle(),
        ];
    }

    /**
     * Create the bulk actions for managing multiple themes.
     *
     * @return array<int, BulkAction>
     */
    protected static function getBulkActions(): array
    {
        return [
            BulkAction::make('publishAssets')
                ->label(__('themer-luncher::themes.bulk_actions.publish_assets'))
                ->icon('heroicon-o-arrow-up-tray')
                ->color('info')
                ->action(function (Collection $records, ThemeService $service): void {
                    foreach ($records as $record) {
                        $service->publishAssets($record->name);
                    }

                    Notification::make()
                        ->title(__('themer-luncher::themes.notifications.bulk_assets_published', ['count' => $records->count()]))
                        ->success()
                        ->send();
                }),

            BulkAction::make('backup')
                ->label(__('themer-luncher::themes.bulk_actions.backup'))
                ->icon('heroicon-o-archive-box')
                ->color('gray')
                ->action(function (Collection $records, ThemeService $service): void {
                    foreach ($records as $record) {
                        $service->backup($record->name);
                    }

                    Notification::make()
                        ->title(__('themer-luncher::themes.notifications.bulk_backed_up', ['count' => $records->count()]))
                        ->success()
                        ->send();
                }),

            BulkAction::make('delete')
                ->label(__('themer-luncher::themes.bulk_actions.delete'))
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function (Collection $records, ThemeService $service): void {
                    $count = 0;
                    foreach ($records as $record) {
                        if ($record->is_removeable) {
                            $service->delete($record->name);
                            $count++;
                        }
                    }

                    Notification::make()
                        ->title(__('themer-luncher::themes.notifications.bulk_deleted', ['count' => $count]))
                        ->success()
                        ->send();
                }),
        ];
    }
}
