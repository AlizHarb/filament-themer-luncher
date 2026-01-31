<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Exceptions;

use Exception;

/**
 * Exception thrown when a theme operation is not supported.
 */
final class ThemeOperationNotSupportedException extends Exception
{
    public static function make(string $operation): self
    {
        return new self(__('themer-luncher::themes.errors.operations.not_supported', ['operation' => $operation]));
    }
}
