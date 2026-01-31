<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\Pages;

use AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource;
use Filament\Resources\Pages\ViewRecord;

/**
 * Page class for viewing theme details.
 */
class ViewTheme extends ViewRecord
{
    /** @var string The resource associated with the page */
    protected static string $resource = ThemeResource::class;
}
