<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\Schemas;

use AlizHarb\ThemerLuncher\Models\Theme;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

/**
 * Static schema configuration for the theme information display.
 */
final class ThemeInfolist
{
    /**
     * Configure the provided schema with infolist components.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('themer-luncher::themes.sections.identity.label'))
                    ->icon('heroicon-o-identification')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('name')
                                ->label(__('themer-luncher::themes.fields.name.label'))
                                ->weight('bold'),
                            TextEntry::make('slug')
                                ->label(__('themer-luncher::themes.fields.slug.label'))
                                ->fontFamily('mono'),
                            TextEntry::make('version')
                                ->label(__('themer-luncher::themes.fields.version.label'))
                                ->badge()
                                ->color('info'),
                        ]),
                        TextEntry::make('description')
                            ->label(__('themer-luncher::themes.fields.description.label'))
                            ->markdown(),
                    ]),

                Section::make(__('themer-luncher::themes.fields.authors.label'))
                    ->icon('heroicon-o-users')
                    ->schema([
                        TextEntry::make('authors')
                            ->hiddenLabel()
                            ->html()
                            ->formatStateUsing(function (mixed $state): string {
                                $authors = collect((array) $state)->map(function (mixed $author): string {
                                    $name = is_string($author) ? $author : ($author['name'] ?? 'Unknown');
                                    $email = is_array($author) ? ($author['email'] ?? null) : null;
                                    $role = is_array($author) ? ($author['role'] ?? 'Developer') : 'Contributor';

                                    return "
                                        <div class='flex items-center gap-3 p-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm'>
                                            <div class='flex-1'>
                                                <div class='font-medium text-gray-900 dark:text-gray-100'>{$name}</div>
                                                ".($email !== null ? "<div class='text-xs text-gray-500 dark:text-gray-400'>{$email}</div>" : '')."
                                            </div>
                                            <div class='text-xs font-mono px-2 py-1 rounded bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300'>
                                                {$role}
                                            </div>
                                        </div>
                                    ";
                                })->join('');

                                return "<div class='grid grid-cols-1 md:grid-cols-2 gap-4'>{$authors}</div>";
                            }),
                    ]),

                Section::make(__('themer-luncher::themes.sections.architecture.label'))
                    ->icon('heroicon-o-cpu-chip')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('parent')
                                ->label(__('themer-luncher::themes.fields.parent.label'))
                                ->placeholder(__('themer-luncher::themes.options.none'))
                                ->badge()
                                ->color('gray'),
                            TextEntry::make('is_active')
                                ->label(__('themer-luncher::themes.fields.status.label'))
                                ->badge()
                                ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                                ->formatStateUsing(fn (bool $state): string => $state
                                    ? __('themer-luncher::themes.options.active')
                                    : __('themer-luncher::themes.options.inactive')),
                        ]),
                        Grid::make(4)->schema([
                            TextEntry::make('has_views')
                                ->label(__('themer-luncher::themes.filters.has_views'))
                                ->badge()
                                ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                                ->formatStateUsing(fn (bool $state): string => $state ? 'Yes' : 'No'),
                            TextEntry::make('has_translations')
                                ->label(__('themer-luncher::themes.filters.has_translations'))
                                ->badge()
                                ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                                ->formatStateUsing(fn (bool $state): string => $state ? 'Yes' : 'No'),
                            TextEntry::make('has_livewire')
                                ->label(__('themer-luncher::themes.filters.has_livewire'))
                                ->badge()
                                ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                                ->formatStateUsing(fn (bool $state): string => $state ? 'Yes' : 'No'),
                            TextEntry::make('has_provider')
                                ->label(__('themer-luncher::themes.fields.has_provider.label'))
                                ->badge()
                                ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                                ->formatStateUsing(fn (bool $state): string => $state ? 'Yes' : 'No'),
                        ]),
                    ]),

                Section::make(__('themer-luncher::themes.sections.paths.label'))
                    ->icon('heroicon-o-folder')
                    ->schema([
                        TextEntry::make('path')
                            ->label(__('themer-luncher::themes.fields.path.label'))
                            ->fontFamily('mono')
                            ->size('xs'),
                        TextEntry::make('asset_path')
                            ->label(__('themer-luncher::themes.fields.asset_path.label'))
                            ->fontFamily('mono')
                            ->size('xs'),
                    ]),
            ]);
    }
}
