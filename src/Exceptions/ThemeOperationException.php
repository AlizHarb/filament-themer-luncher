<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Exceptions;

use Exception;

/**
 * Exception thrown when theme operations fail.
 */
final class ThemeOperationException extends Exception
{
    public static function backupFailed(string $themeName, string $reason): self
    {
        return new self(__('themer-luncher::themes.errors.operations.backup_failed', [
            'name' => $themeName,
            'reason' => $reason,
        ]));
    }

    public static function restoreFailed(string $themeName, string $reason): self
    {
        return new self(__('themer-luncher::themes.errors.operations.restore_failed', [
            'name' => $themeName,
            'reason' => $reason,
        ]));
    }

    public static function deleteFailed(string $themeName, string $reason): self
    {
        return new self(__('themer-luncher::themes.errors.operations.delete_failed', [
            'name' => $themeName,
            'reason' => $reason,
        ]));
    }

    public static function activationFailed(string $themeName, string $reason): self
    {
        return new self(__('themer-luncher::themes.errors.operations.activation_failed', [
            'name' => $themeName,
            'reason' => $reason,
        ]));
    }

    public static function notFound(string $themeName): self
    {
        return new self(__('themer-luncher::themes.errors.operations.not_found', ['name' => $themeName]));
    }
}
