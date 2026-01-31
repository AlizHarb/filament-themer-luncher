<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Exceptions;

use Exception;

/**
 * Exception thrown when theme installation fails.
 */
final class ThemeInstallationException extends Exception
{
    public static function invalidSource(string $source): self
    {
        return new self(__('themer-luncher::themes.errors.installation.invalid_source', ['source' => $source]));
    }

    public static function downloadFailed(string $url, string $reason): self
    {
        return new self(__('themer-luncher::themes.errors.installation.download_failed', [
            'url' => $url,
            'reason' => $reason,
        ]));
    }

    public static function extractionFailed(string $file, string $reason): self
    {
        return new self(__('themer-luncher::themes.errors.installation.extraction_failed', [
            'file' => $file,
            'reason' => $reason,
        ]));
    }

    public static function missingMetadata(string $path): self
    {
        return new self(__('themer-luncher::themes.errors.installation.missing_metadata', ['path' => $path]));
    }

    public static function invalidMetadata(string $path): self
    {
        return new self(__('themer-luncher::themes.errors.installation.invalid_metadata', ['path' => $path]));
    }

    public static function alreadyExists(string $name): self
    {
        return new self(__('themer-luncher::themes.errors.installation.already_exists', ['name' => $name]));
    }
}
