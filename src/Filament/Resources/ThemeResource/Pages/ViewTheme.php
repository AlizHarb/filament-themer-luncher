<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\Pages;

use AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource;
use AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\Tables\ThemeTable;
use AlizHarb\ThemerLuncher\Models\Theme;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

/**
 * Page class for viewing theme details.
 */
class ViewTheme extends ViewRecord
{
    /** @var string The resource associated with the page */
    protected static string $resource = ThemeResource::class;

    /**
     * Get the header actions for the page.
     *
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            ThemeTable::activateAction()
                ->hidden(fn (Theme $record): bool => $record->is_active),
            ThemeTable::previewAction(),
        ];
    }
}
