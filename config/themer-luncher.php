<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Theme Resource Configuration
    |--------------------------------------------------------------------------
    */

    'resource' => [
        'enabled' => env('THEMER_LUNCHER_RESOURCE_ENABLED', true),
        'label' => 'themer-luncher::themes.resource.label',
        'plural_label' => 'themer-luncher::themes.resource.plural_label',
        'navigation_icon' => env('THEMER_LUNCHER_NAV_ICON', 'heroicon-o-paint-brush'),
        'navigation_label' => 'themer-luncher::themes.resource.navigation_label',
        'navigation_group' => 'themer-luncher::themes.resource.navigation_group',
        'navigation_sort' => env('THEMER_LUNCHER_NAV_SORT', null),
        'should_register_navigation' => env('THEMER_LUNCHER_NAV_REGISTER', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme Installation
    |--------------------------------------------------------------------------
    */

    'installation' => [
        'enabled' => env('THEMER_LUNCHER_INSTALL_ENABLED', true),
        'disk' => env('THEMER_LUNCHER_INSTALL_DISK', 'local'),
        'temp_path' => env('THEMER_LUNCHER_INSTALL_TEMP', 'temp_themes'),
        'allowed_sources' => ['zip', 'url', 'git', 'local'],
        'max_upload_size' => env('THEMER_LUNCHER_MAX_UPLOAD_SIZE', 50),
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme Backups
    |--------------------------------------------------------------------------
    */

    'backups' => [
        'enabled' => env('THEMER_LUNCHER_BACKUPS_ENABLED', true),
        'storage_path' => env('THEMER_LUNCHER_BACKUP_PATH', 'theme-backups'),
        'keep_last' => env('THEMER_LUNCHER_BACKUP_KEEP', 5),
        'retention_days' => env('THEMER_LUNCHER_BACKUP_RETENTION', 30),
    ],

    /*
    |--------------------------------------------------------------------------
    | Widgets Configuration
    |--------------------------------------------------------------------------
    */

    'widgets' => [
        'enabled' => env('THEMER_LUNCHER_WIDGETS_ENABLED', true),
        'polling_interval' => env('THEMER_LUNCHER_WIDGET_POLLING', '30s'),
        'display_on' => [
            'dashboard' => env('THEMER_LUNCHER_WIDGETS_DASHBOARD', true),
            'table' => env('THEMER_LUNCHER_WIDGETS_TABLE', true),
        ],
        'display' => [
            'stats' => env('THEMER_LUNCHER_WIDGETS_DISPLAY_STATS', true),
            'recent' => env('THEMER_LUNCHER_WIDGETS_DISPLAY_RECENT', false),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Authorization
    |--------------------------------------------------------------------------
    */

    'authorization' => [
        'enabled' => env('THEMER_LUNCHER_AUTH_ENABLED', false),
        'default_deny' => env('THEMER_LUNCHER_DEFAULT_DENY', false),
        'permissions' => [
            'viewAny' => null,
            'view' => null,
            'create' => null,
            'update' => null,
            'delete' => null,
            'activate' => null,
            'backup' => null,
            'restore' => null,
            'publishAssets' => null,
            'clearCache' => null,
        ],
    ],
];
