<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Data;

use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\RequiredIf;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

/**
 * Data transfer object for theme installation.
 */
final class InstallThemeData extends Data
{
    public function __construct(
        #[In(['zip', 'url', 'git', 'local'])]
        public string $source_type,
        #[RequiredIf('source_type', 'zip')]
        public ?string $file_path = null,
        #[RequiredIf('source_type', 'url')]
        #[Url]
        public ?string $url = null,
        #[RequiredIf('source_type', 'git')]
        public ?string $git_repo = null,
        #[RequiredIf('source_type', 'local')]
        public ?string $local_path = null,
        public bool $activate_after_install = false,
    ) {}
}
