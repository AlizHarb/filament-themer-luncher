<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Policies;

use AlizHarb\ThemerLuncher\Models\Theme;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Gate;

/**
 * Premium Theme Policy with full config-based customization.
 */
final class ThemePolicy
{
    /**
     * Determine if the user can view any themes.
     */
    public function viewAny(?Authenticatable $user): bool
    {
        if (! (bool) config('themer-luncher.authorization.enabled', true)) {
            return true;
        }

        if ($this->hasConfigPermission('viewAny')) {
            return true;
        }

        if (Gate::has('theme:viewAny')) {
            return Gate::allows('theme:viewAny', $user);
        }

        if ($user instanceof Authorizable) {
            return (bool) $user->can('theme:viewAny');
        }

        return (bool) config('themer-luncher.authorization.default_deny', false);
    }

    /**
     * Determine if the user can view a specific theme.
     */
    public function view(?Authenticatable $user, Theme $theme): bool
    {
        if (! (bool) config('themer-luncher.authorization.enabled', true)) {
            return true;
        }

        if ($this->hasConfigPermission('view')) {
            return true;
        }

        if (Gate::has('theme:view')) {
            return Gate::allows('theme:view', [$user, $theme]);
        }

        if ($user instanceof Authorizable) {
            return (bool) $user->can('theme:view');
        }

        return (bool) config('themer-luncher.authorization.default_deny', false);
    }

    /**
     * Determine if the user can create themes.
     */
    public function create(?Authenticatable $user): bool
    {
        if (! (bool) config('themer-luncher.authorization.enabled', true)) {
            return true;
        }

        if ($this->hasConfigPermission('create')) {
            return true;
        }

        if (Gate::has('theme:create')) {
            return Gate::allows('theme:create', $user);
        }

        if ($user instanceof Authorizable) {
            return (bool) $user->can('theme:create');
        }

        return (bool) config('themer-luncher.authorization.default_deny', false);
    }

    /**
     * Determine if the user can update themes.
     */
    public function update(?Authenticatable $user, Theme $theme): bool
    {
        if (! (bool) config('themer-luncher.authorization.enabled', true)) {
            return true;
        }

        if ($this->hasConfigPermission('update')) {
            return true;
        }

        if (Gate::has('theme:update')) {
            return Gate::allows('theme:update', [$user, $theme]);
        }

        if ($user instanceof Authorizable) {
            return (bool) $user->can('theme:update');
        }

        return (bool) config('themer-luncher.authorization.default_deny', false);
    }

    /**
     * Determine if the user can delete themes.
     */
    public function delete(?Authenticatable $user, Theme $theme): bool
    {
        if (! (bool) config('themer-luncher.authorization.enabled', true)) {
            return true;
        }

        if ($this->hasConfigPermission('delete')) {
            return true;
        }

        if (Gate::has('theme:delete')) {
            return Gate::allows('theme:delete', [$user, $theme]);
        }

        if ($user instanceof Authorizable) {
            return (bool) $user->can('theme:delete');
        }

        return (bool) config('themer-luncher.authorization.default_deny', false);
    }

    /**
     * Determine if the user can activate themes.
     */
    public function activate(?Authenticatable $user, Theme $theme): bool
    {
        if (! (bool) config('themer-luncher.authorization.enabled', true)) {
            return true;
        }

        if ($this->hasConfigPermission('activate')) {
            return true;
        }

        if (Gate::has('theme:activate')) {
            return Gate::allows('theme:activate', [$user, $theme]);
        }

        if ($user instanceof Authorizable) {
            return (bool) $user->can('theme:activate');
        }

        return $this->update($user, $theme);
    }

    /**
     * Determine if the user can backup themes.
     */
    public function backup(?Authenticatable $user, Theme $theme): bool
    {
        if (! (bool) config('themer-luncher.authorization.enabled', true)) {
            return true;
        }

        if ($this->hasConfigPermission('backup')) {
            return true;
        }

        if (Gate::has('theme:backup')) {
            return Gate::allows('theme:backup', [$user, $theme]);
        }

        if ($user instanceof Authorizable) {
            return (bool) $user->can('theme:backup');
        }

        return $this->update($user, $theme);
    }

    /**
     * Determine if the user can restore themes.
     */
    public function restore(?Authenticatable $user, Theme $theme): bool
    {
        if (! (bool) config('themer-luncher.authorization.enabled', true)) {
            return true;
        }

        if ($this->hasConfigPermission('restore')) {
            return true;
        }

        if (Gate::has('theme:restore')) {
            return Gate::allows('theme:restore', [$user, $theme]);
        }

        if ($user instanceof Authorizable) {
            return (bool) $user->can('theme:restore');
        }

        return $this->update($user, $theme);
    }

    /**
     * Check if a permission is allowed via config.
     */
    protected function hasConfigPermission(string $action): bool
    {
        $permissions = config('themer-luncher.authorization.permissions', []);

        if (isset($permissions[$action])) {
            return (bool) $permissions[$action];
        }

        if (isset($permissions['*'])) {
            return (bool) $permissions['*'];
        }

        return false;
    }
}
