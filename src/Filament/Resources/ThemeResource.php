<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Filament\Resources;

use AlizHarb\ThemerLuncher\Filament\Plugins\ThemerLuncherPlugin;
use AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\Pages\ListThemes;
use AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\Pages\ViewTheme;
use AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\RelationManagers\ThemeBackupsRelationManager;
use AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\Schemas\ThemeInfolist;
use AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\Tables\ThemeTable;
use AlizHarb\ThemerLuncher\Models\Theme;
use AlizHarb\ThemerLuncher\Policies\ThemePolicy;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

/**
 * Resource for managing system themes within Filament.
 *
 * Provides a comprehensive interface for listing, viewing, and managing
 * themes, including backup management and activation.
 */
class ThemeResource extends Resource
{
    /** @var class-string<Model>|null The Eloquent model associated with the resource */
    protected static ?string $model = Theme::class;

    /** @var string|null The policy class for authorizing actions */
    protected static ?string $policy = ThemePolicy::class;

    /**
     * Get the localized model label.
     */
    public static function getModelLabel(): string
    {
        try {
            return ThemerLuncherPlugin::get()->getLabel();
        } catch (\Throwable $e) {
            return (string) __(config('themer-luncher.resource.label'));
        }
    }

    /**
     * Get the localized plural model label.
     */
    public static function getPluralModelLabel(): string
    {
        try {
            return ThemerLuncherPlugin::get()->getPluralLabel();
        } catch (\Throwable $e) {
            return (string) __(config('themer-luncher.resource.plural_label'));
        }
    }

    /**
     * Get the navigation icon for the resource.
     */
    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        try {
            return ThemerLuncherPlugin::get()->getNavigationIcon() ?? parent::getNavigationIcon();
        } catch (\Throwable $e) {
            return config('themer-luncher.resource.navigation_icon', 'heroicon-o-paint-brush');
        }
    }

    /**
     * Get the localized navigation label.
     */
    public static function getNavigationLabel(): string
    {
        try {
            return ThemerLuncherPlugin::get()->getLabel();
        } catch (\Throwable $e) {
            return (string) __(config('themer-luncher.resource.navigation_label'));
        }
    }

    /**
     * Get the localized navigation group.
     */
    public static function getNavigationGroup(): ?string
    {
        try {
            $group = ThemerLuncherPlugin::get()->getNavigationGroup();
            if ($group instanceof \UnitEnum) {
                return $group->name;
            }

            return (string) $group;
        } catch (\Throwable $e) {
            $key = config('themer-luncher.resource.navigation_group');

            return (bool) $key ? (string) __($key) : null;
        }
    }

    /**
     * Get the navigation sort order.
     */
    public static function getNavigationSort(): ?int
    {
        try {
            return ThemerLuncherPlugin::get()->getNavigationSort();
        } catch (\Throwable $e) {
            return (int) config('themer-luncher.resource.navigation_sort');
        }
    }

    /**
     * Get the navigation badge for the resource.
     */
    public static function getNavigationBadge(): ?string
    {
        try {
            return ThemerLuncherPlugin::get()->getNavigationCountBadge();
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Configure the table for the resource.
     */
    public static function table(Table $table): Table
    {
        return ThemeTable::configure($table);
    }

    /**
     * Configure the infolist for the resource.
     */
    public static function infolist(Schema $schema): Schema
    {
        return ThemeInfolist::configure($schema);
    }

    /**
     * Get the relations for the resource.
     *
     * @return array<class-string<\Filament\Resources\RelationManagers\RelationManager>|\Filament\Resources\RelationManagers\RelationGroup|\Filament\Resources\RelationManagers\RelationManagerConfiguration>
     */
    public static function getRelations(): array
    {
        return [
            ThemeBackupsRelationManager::class,
        ];
    }

    /**
     * Get the pages for the resource.
     *
     * @return array<string, \Filament\Resources\Pages\PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListThemes::route('/'),
            'view' => ViewTheme::route('/{record}'),
        ];
    }
}
