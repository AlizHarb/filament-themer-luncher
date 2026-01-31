<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Services;

use AlizHarb\Themer\Facades\Theme as ThemeFacade;
use AlizHarb\ThemerLuncher\Data\InstallThemeData;
use AlizHarb\ThemerLuncher\Exceptions\ThemeInstallationException;
use AlizHarb\ThemerLuncher\Exceptions\ThemeOperationException;
use AlizHarb\ThemerLuncher\Exceptions\ThemeOperationNotSupportedException;
use AlizHarb\ThemerLuncher\Models\Theme;
use AlizHarb\ThemerLuncher\Models\ThemeBackup;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use ZipArchive;

/**
 * Service class for theme operations.
 *
 * Handles theme activation, installation, backup, restore, and deletion.
 */
final class ThemeService
{
    /**
     * Activate a theme.
     *
     * @throws ThemeOperationException
     */
    public function activate(string $name): void
    {
        try {
            if (empty($name)) {
                // Deactivate by setting no active theme
                // We use a blank string if the facade supports it, or handle it gracefully
                try {
                    ThemeFacade::set('');
                } catch (\Exception $e) {
                    // Fallback to manual reset if set('') is not supported
                    $manager = app(\AlizHarb\Themer\ThemeManager::class);
                    $reflection = new \ReflectionClass($manager);
                    $property = $reflection->getProperty('activeTheme');
                    $property->setAccessible(true);
                    $property->setValue($manager, null);
                }

                return;
            }

            ThemeFacade::set($name);
        } catch (\Exception $e) {
            if (!empty($name)) {
                throw ThemeOperationException::activationFailed($name, $e->getMessage());
            }
        }
    }

    /**
     * Install a theme from various sources.
     *
     * @throws ThemeInstallationException
     * @throws ThemeOperationNotSupportedException
     */
    public function install(InstallThemeData $data): void
    {
        if (!config('themer-luncher.installation.enabled', true)) {
            throw ThemeOperationNotSupportedException::make('installation');
        }

        $allowedSources = config('themer-luncher.installation.allowed_sources', ['zip', 'url', 'git', 'local']);

        if (!in_array($data->source_type, $allowedSources, true)) {
            throw ThemeInstallationException::invalidSource($data->source_type);
        }

        match ($data->source_type) {
            'zip' => $this->installFromZip($data->file_path),
            'url' => $this->installFromUrl($data->url),
            'git' => $this->installFromGit($data->git_repo),
            'local' => $this->installFromLocal($data->local_path),
            default => throw ThemeInstallationException::invalidSource($data->source_type),
        };

        // Clear theme cache after installation
        $this->clearCache();

        if ($data->activate_after_install) {
            // Get the theme name from the installed theme
            $themesPath = config('themer.themes_path', base_path('themes'));
            $directories = File::directories($themesPath);
            $lastTheme = end($directories);

            if ($lastTheme) {
                $this->activate(basename($lastTheme));
            }
        }
    }

    /**
     * Install theme from ZIP file.
     *
     * @param  string|null  $filePath  The absolute path to the ZIP file.
     *
     * @throws ThemeInstallationException If validation or extraction fails.
     */
    protected function installFromZip(?string $filePath): void
    {
        if (!$filePath || !file_exists($filePath)) {
            throw ThemeInstallationException::extractionFailed($filePath ?? 'null', 'File not found');
        }

        $zip = new ZipArchive;

        if ($zip->open($filePath) !== true) {
            throw ThemeInstallationException::extractionFailed($filePath, 'Cannot open ZIP file');
        }

        $themesPath = config('themer.themes_path', base_path('themes'));

        // @phpstan-ignore-next-line
        if (!File::isDirectory($themesPath)) {
            File::makeDirectory($themesPath, 0755, true);
        }

        // Extract to temporary directory first
        /** @phpstan-ignore-next-line */
        $tempPath = sys_get_temp_dir().'/theme-'.uniqid();
        $zip->extractTo($tempPath);
        $zip->close();

        // Find theme.json in extracted files
        $themeJsonPath = $this->findThemeJson($tempPath);

        if (!$themeJsonPath) {
            File::deleteDirectory($tempPath);

            throw ThemeInstallationException::missingMetadata($tempPath);
        }

        // Get theme name from theme.json
        $themeDir = dirname($themeJsonPath);
        $themeName = basename($themeDir);

        // Move to themes directory
        $destination = $themesPath.'/'.$themeName;

        if (File::exists($destination)) {
            File::deleteDirectory($tempPath);

            throw ThemeInstallationException::alreadyExists($themeName);
        }

        File::moveDirectory($themeDir, $destination);
        File::deleteDirectory($tempPath);
    }

    /**
     * Install theme from URL.
     *
     * @param  string|null  $url  The direct download URL for the theme ZIP.
     *
     * @throws ThemeInstallationException If download fails.
     */
    protected function installFromUrl(?string $url): void
    {
        if (!$url) {
            throw ThemeInstallationException::downloadFailed('null', 'URL is required');
        }

        $tempFile = tempnam(sys_get_temp_dir(), 'theme_');

        try {
            $contents = file_get_contents($url);

            if ($contents === false) {
                throw ThemeInstallationException::downloadFailed($url, 'Failed to download file');
            }

            file_put_contents($tempFile, $contents);
            $this->installFromZip($tempFile);
        } finally {
            if (file_exists($tempFile)) {
                unlink($tempFile);
            }
        }
    }

    /**
     * Install theme from Git repository.
     *
     * @param  string|null  $repo  The Git repository URL.
     *
     * @throws ThemeInstallationException If git clone fails.
     */
    protected function installFromGit(?string $repo): void
    {
        if (!$repo) {
            throw ThemeInstallationException::downloadFailed('null', 'Git repository is required');
        }

        $themesPath = config('themer.themes_path', base_path('themes'));
        $themeName = basename($repo, '.git');
        $destination = $themesPath.'/'.$themeName;

        if (File::exists($destination)) {
            throw new ThemeInstallationException("Theme '{$themeName}' already exists");
        }

        exec("git clone {$repo} {$destination} 2>&1", $output, $returnCode);

        if ($returnCode !== 0) {
            throw ThemeInstallationException::downloadFailed($repo, implode("\n", $output));
        }
    }

    /**
     * Install theme from local path (symlink).
     *
     * @param  string|null  $localPath  The absolute path to the local theme directory.
     *
     * @throws ThemeInstallationException If path invalid or symlink fails.
     */
    protected function installFromLocal(?string $localPath): void
    {
        if (!$localPath || !File::isDirectory($localPath)) {
            throw ThemeInstallationException::invalidSource('local: path not found');
        }

        $themesPath = config('themer.themes_path', base_path('themes'));
        $themeName = basename($localPath);
        $destination = $themesPath.'/'.$themeName;

        if (File::exists($destination)) {
            throw new ThemeInstallationException("Theme '{$themeName}' already exists");
        }

        if (!symlink($localPath, $destination)) {
            throw ThemeInstallationException::extractionFailed($themeName, __('themer-luncher::themes.errors.installation.symlink_failed'));
        }
    }

    /**
     * Find theme.json in directory recursively.
     */
    protected function findThemeJson(string $directory): ?string
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getFilename() === 'theme.json') {
                return $file->getPathname();
            }
        }

        return null;
    }

    /**
     * Create a backup of a theme.
     *
     * @throws ThemeOperationException
     * @throws ThemeOperationNotSupportedException
     */
    public function backup(string $name): ThemeBackup
    {
        if (!config('themer-luncher.backups.enabled', true)) {
            throw ThemeOperationNotSupportedException::make('backup');
        }

        /** @var Theme|null $theme */
        $theme = Theme::find($name);

        if (!$theme) {
            throw ThemeOperationException::notFound($name);
        }

        /** @var Theme $theme */
        $themePath = $theme->path;

        $backupPath = storage_path('app/'.config('themer-luncher.backups.storage_path', 'theme-backups'));

        if (!File::isDirectory($backupPath)) {
            File::makeDirectory($backupPath, 0755, true);
        }

        $timestamp = now()->format('Y-m-d_His');
        $filename = "{$name}_{$timestamp}.zip";
        $fullPath = $backupPath.'/'.$filename;

        try {
            $zip = new ZipArchive;

            if ($zip->open($fullPath, ZipArchive::CREATE) !== true) {
                throw ThemeOperationException::backupFailed($name, 'Cannot create ZIP file');
            }

            $this->addDirectoryToZip($zip, $themePath, $name);
            $zip->close();

            // Clean up old backups
            $this->cleanupOldBackups($name);

            return ThemeBackup::find($filename);
        } catch (\Exception $e) {
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            throw ThemeOperationException::backupFailed($name, $e->getMessage());
        }
    }

    /**
     * Add directory to ZIP archive recursively.
     */
    protected function addDirectoryToZip(ZipArchive $zip, string $directory, string $localPath = ''): void
    {
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $relativePath = $localPath.'/'.substr($filePath, strlen($directory) + 1);

            if ($file->isDir()) {
                $zip->addEmptyDir($relativePath);
            } else {
                $zip->addFile($filePath, $relativePath);
            }
        }
    }

    /**
     * Clean up old backups keeping only the last N backups.
     */
    protected function cleanupOldBackups(string $themeName): void
    {
        $keepLast = config('themer-luncher.backups.keep_last', 5);

        $backups = $this->getBackups($themeName);

        if (count($backups) > $keepLast) {
            $toDelete = array_slice($backups, $keepLast);

            foreach ($toDelete as $backup) {
                $storageDir = config('themer-luncher.backups.storage_path', 'theme-backups');
                $fullPath = storage_path('app/'.$storageDir).'/'.$backup['filename'];

                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        }
    }

    /**
     * Retrieve all available backups for a theme.
     *
     * @return array<int, array{filename: string, size: int, created_at: int}>
     */
    public function getBackups(string $name): array
    {
        $storageDir = config('themer-luncher.backups.storage_path', 'theme-backups');
        $backupPath = storage_path('app/'.$storageDir);

        if (!File::isDirectory($backupPath)) {
            return [];
        }

        $files = File::glob($backupPath.DIRECTORY_SEPARATOR."{$name}_*.zip");

        if ($files === []) {
            return [];
        }

        return collect($files)->map(function ($path) {
            return [
                'filename' => basename($path),
                'size' => filesize($path),
                'created_at' => filemtime($path),
            ];
        })->sortByDesc('created_at')->values()->toArray();
    }

    /**
     * Restore a theme from backup.
     *
     * @throws ThemeOperationException
     */
    public function restore(string $name, ?string $backupFile = null): void
    {
        /** @var ThemeBackup $backup */
        $backup = $backupFile
            ? ThemeBackup::where('theme_name', $name)->where('filename', $backupFile)->firstOrFail()
            : ThemeBackup::where('theme_name', $name)->latest()->firstOrFail();

        /** @var ThemeBackup $backup */
        $backupPath = storage_path('app/'.$backup->path);

        if (!file_exists($backupPath)) {
            throw ThemeOperationException::restoreFailed($name, __('themer-luncher::themes.errors.no_backup_found', ['name' => $name]));
        }

        $themesPath = config('themer.themes_path', base_path('themes'));
        $themePath = $themesPath.'/'.$name;

        // Delete existing theme
        if (File::isDirectory($themePath)) {
            File::deleteDirectory($themePath);
        }

        // Extract backup
        $zip = new ZipArchive;
        /** @var ThemeBackup $backup */
        $fullPath = storage_path('app/'.$backup->path);

        if ($zip->open($fullPath) !== true) {
            throw ThemeOperationException::restoreFailed($name, 'Cannot open backup file');
        }

        $zip->extractTo($themesPath);
        $zip->close();

        // Clear cache
        $this->clearCache();
    }

    /**
     * Delete a theme.
     *
     * @throws ThemeOperationException
     */
    public function delete(string $name): void
    {
        $theme = ThemeFacade::all()->get($name);

        if (!$theme) {
            throw ThemeOperationException::notFound($name);
        }

        $model = Theme::find($name);

        if ($model instanceof Theme && !$model->is_removeable) {
            if ($model->is_active) {
                throw new ThemeOperationException(__('themer-luncher::themes.errors.active_cannot_delete'));
            }
            if ($name === 'default') {
                throw new ThemeOperationException(__('themer-luncher::themes.errors.default_cannot_delete'));
            }

            throw new ThemeOperationException(__('themer-luncher::themes.errors.parent_cannot_delete'));
        }

        // Delete backups
        /** @var \Illuminate\Database\Eloquent\Collection<int, ThemeBackup> $backups */
        // @phpstan-ignore-line
        $backups = ThemeBackup::query()->where('theme_name', $name)->get();

        $backups->each(function (ThemeBackup $backup): void {
            $backup->delete();
        });

        // Delete theme directory
        // We get it from the facade directly to be sure and fallback to config path if needed
        $themeInstance = ThemeFacade::all()->get($name);
        $path = $themeInstance->path ?? config('themer.themes_path').'/'.$name;

        if (File::isDirectory($path)) {
            File::deleteDirectory($path);
        }

        // Clear cache
        $this->clearCache();
    }

    /**
     * Clear theme cache.
     */
    public function clearCache(): void
    {
        try {
            // Fallback to artisan command
            Artisan::call('theme:cache');
        } catch (\Exception $e) {
            // If command fails, just continue silently
        }
    }

    /**
     * Publish theme assets.
     *
     * @param  string  $name  The name of the theme to publish assets for.
     */
    public function publishAssets(string $name): void
    {
        $theme = ThemeFacade::all()->get($name);

        if ($theme) {
            ThemeFacade::publishAssets($theme);
        }
    }
}
