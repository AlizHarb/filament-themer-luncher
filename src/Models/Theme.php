<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Models;

use AlizHarb\Themer\Facades\Theme as ThemeFacade;
use AlizHarb\Themer\Theme as ThemerTheme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Sushi\Sushi;

/**
 * Sushi-based model for Laravel Themer themes.
 *
 * Uses Sushi to provide Eloquent interface for file-based theme data
 * without requiring database tables.
 *
 * @property string $name
 * @property string $slug
 * @property string $path
 * @property string $asset_path
 * @property string|null $parent
 * @property array<string, mixed> $config
 * @property string $version
 * @property string|null $author
 * @property array<int, array{name: string, email?: string, role?: string}> $authors
 * @property bool $has_views
 * @property bool $has_translations
 * @property bool $has_provider
 * @property bool $has_livewire
 * @property bool $is_active
 * @property bool $has_parent
 * @property ThemerTheme|null $parent_theme
 * @property string $description
 * @property bool $is_removeable
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder where(string $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static self|null find(string $key)
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
final class Theme extends Model
{
    use Sushi;

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'name';

    /**
     * The "type" of the primary key ID.
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'config' => 'array',
        'authors' => 'array',
        'has_views' => 'boolean',
        'has_translations' => 'boolean',
        'has_provider' => 'boolean',
        'has_livewire' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'is_active',
        'has_parent',
        'description',
        'is_removeable',
    ];

    /**
     * Define the column schema for Sushi.
     *
     * @var array<string, string>
     */
    protected $schema = [
        'name' => 'string',
        'slug' => 'string',
        'path' => 'string',
        'asset_path' => 'string',
        'parent' => 'string',
        'config' => 'string',
        'version' => 'string',
        'author' => 'string',
        'authors' => 'string',
        'has_views' => 'boolean',
        'has_translations' => 'boolean',
        'has_provider' => 'boolean',
        'has_livewire' => 'boolean',
    ];

    /**
     * Get the rows for Sushi from ThemeManager.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getRows(): array
    {
        /** @var \Illuminate\Support\Collection<string, \AlizHarb\Themer\Theme> $themes */
        $themes = ThemeFacade::all();

        return $themes
            ->map(fn (ThemerTheme $theme): array => [
                'name' => (string) $theme->name,
                'slug' => (string) $theme->slug,
                'path' => (string) $theme->path,
                'asset_path' => (string) $theme->assetPath,
                'parent' => $theme->parent, // Keep null as null
                'config' => json_encode($theme->config ?: []) ?: '[]',
                'version' => (string) ($theme->version ?: '1.0.0'),
                'author' => (string) ($theme->author ?? ''),
                'authors' => json_encode($theme->authors ?: []) ?: '[]',
                'has_views' => (bool) $theme->hasViews,
                'has_translations' => (bool) $theme->hasTranslations,
                'has_provider' => (bool) $theme->hasProvider,
                'has_livewire' => (bool) $theme->hasLivewire,
            ])
            ->values()
            ->toArray();
    }

    /**
     * Get the theme backups relationship.
     */
    public function backups(): HasMany
    {
        return $this->hasMany(ThemeBackup::class, 'theme_name', 'name');
    }

    /**
     * Check if this theme is currently active.
     */
    public function getIsActiveAttribute(): bool
    {
        $activeTheme = ThemeFacade::getActiveTheme();

        return $activeTheme?->name === $this->name;
    }

    /**
     * Check if this theme has a parent.
     */
    public function getHasParentAttribute(): bool
    {
        return $this->parent !== null;
    }

    /**
     * Get the parent theme instance.
     */
    public function getParentThemeAttribute(): ?ThemerTheme
    {
        if ($this->parent === null) {
            return null;
        }

        $parent = ThemeFacade::all()->get($this->parent);

        return $parent instanceof ThemerTheme ? $parent : null;
    }

    /**
     * Get the theme description from config.
     */
    public function getDescriptionAttribute(): string
    {
        return (string) ($this->config['description'] ?? __('themer-luncher::themes.errors.no_description'));
    }

    /**
     * Check if the theme can be removed.
     */
    public function getIsRemoveableAttribute(): bool
    {
        // Cannot remove active theme
        if ($this->is_active) {
            return false;
        }

        // Cannot remove the "default" theme
        if ($this->name === 'default') {
            return false;
        }

        // Cannot remove if other themes depend on it
        // We use static::all() to avoid Sushi re-querying if already cached in current request
        $dependents = self::all()->filter(fn (self $theme): bool => $theme->parent === $this->name);

        return $dependents->isEmpty();
    }

    /**
     * Get the underlying Themer Theme object.
     */
    public function getThemerTheme(): ?ThemerTheme
    {
        $theme = ThemeFacade::all()->get($this->name);

        return $theme instanceof ThemerTheme ? $theme : null;
    }
}
