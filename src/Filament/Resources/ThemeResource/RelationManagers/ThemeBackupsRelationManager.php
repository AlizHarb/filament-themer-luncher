<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\RelationManagers;

use AlizHarb\ThemerLuncher\Exceptions\ThemeOperationException;
use AlizHarb\ThemerLuncher\Models\ThemeBackup;
use AlizHarb\ThemerLuncher\Services\ThemeService;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

/**
 * Relation manager for theme backup files.
 */
class ThemeBackupsRelationManager extends RelationManager
{
    /** @var string The name of the relationship on the owner record */
    protected static string $relationship = 'backups';

    /**
     * Get the localized title for the relation manager.
     */
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('themer-luncher::themes.backups.title');
    }

    /**
     * Determine if the relation manager can be viewed for the given record.
     */
    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return (bool) config('themer-luncher.backups.enabled', true);
    }

    /**
     * Configure the table for the relation manager.
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('filename')
            ->columns([
                TextColumn::make('filename')
                    ->label(__('themer-luncher::themes.backups.fields.filename'))
                    ->searchable()
                    ->fontFamily('mono')
                    ->size('xs')
                    ->copyable(),
                TextColumn::make('size')
                    ->label(__('themer-luncher::themes.backups.fields.size'))
                    ->formatStateUsing(fn (int $state): string => number_format($state / 1024 / 1024, 2).' MB')
                    ->badge()
                    ->color('gray')
                    ->icon('heroicon-o-document'),
                TextColumn::make('created_at')
                    ->label(__('themer-luncher::themes.backups.fields.date'))
                    ->dateTime()
                    ->sortable()
                    ->icon('heroicon-o-calendar')
                    ->color('primary'),
            ])
            ->recordActions([
                ActionGroup::make([
                    Action::make('restore')
                        ->label(__('themer-luncher::themes.backups.actions.restore.label'))
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function (ThemeBackup $record, ThemeService $service): void {
                            try {
                                $service->restore($record->theme_name, $record->filename);

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
                        }),
                    Action::make('delete')
                        ->label(__('themer-luncher::themes.backups.actions.delete.label'))
                        ->color('danger')
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->action(function (ThemeBackup $record): void {
                            $backupPath = config('themer-luncher.backups.path', storage_path('app/theme-backups'));
                            $path = $backupPath.DIRECTORY_SEPARATOR.$record->filename;

                            if (File::exists($path)) {
                                File::delete($path);
                            }

                            Notification::make()
                                ->title(__('themer-luncher::themes.backups.notifications.deleted'))
                                ->success()
                                ->send();
                        }),
                ])->icon('heroicon-m-ellipsis-vertical'),
            ])
            ->toolbarActions([
                DeleteBulkAction::make()
                    ->label(__('themer-luncher::themes.backups.actions.delete_bulk.label'))
                    ->action(function (Collection $records): void {
                        $backupPath = config('themer-luncher.backups.path', storage_path('app/theme-backups'));

                        $records->each(function (Model $record) use ($backupPath): void {
                            /** @var ThemeBackup $record */
                            $path = $backupPath.DIRECTORY_SEPARATOR.$record->filename;
                            if (File::exists($path)) {
                                File::delete($path);
                            }
                        });

                        Notification::make()
                            ->title(__('themer-luncher::themes.backups.notifications.bulk_deleted'))
                            ->success()
                            ->send();
                    }),
            ])
            ->emptyStateIcon('heroicon-o-archive-box-x-mark')
            ->emptyStateHeading(__('themer-luncher::themes.backups.empty.heading'))
            ->emptyStateDescription(__('themer-luncher::themes.backups.empty.description'));
    }
}
