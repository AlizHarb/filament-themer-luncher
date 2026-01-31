<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Models;

use AlizHarb\ThemerLuncher\Services\ThemeService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sushi\Sushi;

/**
 * Sushi-based model for theme backups.
 *
 * Provides Eloquent interface over backup ZIP files stored on disk,
 * allowing for filtering and sorting within Filament.
 *
 * @property string $filename
 * @property string $theme_name
 * @property int $size
 * @property string $created_at
 * @property-read string $formatted_size
 * @property string $path
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ThemeBackup query()
 * @method static \Illuminate\Database\Eloquent\Builder|ThemeBackup where(string $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static self|null find(string $key)
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
final class ThemeBackup extends Model
{
    use Sushi;

    /** @var array<int, string> The attributes that are mass assignable */
    protected $fillable = [
        'theme_name',
        'filename',
        'path',
        'size',
    ];

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'filename';

    /**
     * The "type" of the primary key.
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

    /**
     * Populate the Sushi in-memory database rows from backup files.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getRows(): array
    {
        /** @var ThemeService $service */
        $service = app(ThemeService::class);
        $themes = Theme::all();
        $rows = [];

        foreach ($themes as $theme) {
            $backups = $service->getBackups($theme->name);

            foreach ($backups as $backup) {
                $rows[] = [
                    'filename' => $backup['filename'],
                    'theme_name' => $theme->name,
                    'size' => $backup['size'],
                    'created_at' => date('Y-m-d H:i:s', $backup['created_at']),
                ];
            }
        }

        return $rows;
    }

    /**
     * Define the column schema for Sushi.
     *
     * @var array<string, string>
     */
    protected $schema = [
        'filename' => 'string',
        'theme_name' => 'string',
        'size' => 'integer',
        'created_at' => 'datetime',
    ];

    /**
     * Get the theme that this backup belongs to.
     *
     * @return BelongsTo<Theme, $this>
     */
    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class, 'theme_name', 'name');
    }

    /**
     * Get the formatted file size.
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2).' '.$units[$i];
    }

    /**
     * Get the relative path to the backup file.
     */
    public function getPathAttribute(): string
    {
        $dir = config('themer-luncher.backups.storage_path', 'theme-backups');

        return $dir.'/'.$this->filename;
    }
}
