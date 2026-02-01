<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Policies;

use AlizHarb\ThemerLuncher\Models\ThemeBackup;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Gate;

/**
 * Policy for managing theme backups.
 */
final class ThemeBackupPolicy
{
    /**
     * Determine if the user can view any theme backups.
     */
    public function viewAny(?Authenticatable $user): bool
    {
        if (! (bool) config('themer-luncher.authorization.enabled', true)) {
            return true;
        }

        if (Gate::has('theme_backup:viewAny')) {
            return Gate::allows('theme_backup:viewAny', $user);
        }

        if ($user instanceof Authorizable) {
            return (bool) $user->can('theme_backup:viewAny');
        }

        return (bool) config('themer-luncher.authorization.default_deny', false);
    }

    /**
     * Determine if the user can delete a theme backup.
     */
    public function delete(?Authenticatable $user, ThemeBackup $backup): bool
    {
        if (! (bool) config('themer-luncher.authorization.enabled', true)) {
            return true;
        }

        if (Gate::has('theme_backup:delete')) {
            return Gate::allows('theme_backup:delete', [$user, $backup]);
        }

        if ($user instanceof Authorizable) {
            return (bool) $user->can('theme_backup:delete');
        }

        return (bool) config('themer-luncher.authorization.default_deny', false);
    }

    /**
     * Determine if the user can restore a theme backup.
     */
    public function restore(?Authenticatable $user, ThemeBackup $backup): bool
    {
        if (! (bool) config('themer-luncher.authorization.enabled', true)) {
            return true;
        }

        if (Gate::has('theme_backup:restore')) {
            return Gate::allows('theme_backup:restore', [$user, $backup]);
        }

        if ($user instanceof Authorizable) {
            return (bool) $user->can('theme_backup:restore');
        }

        return (bool) config('themer-luncher.authorization.default_deny', false);
    }
}
