<?php

declare(strict_types=1);

return [
    'resource' => [
        'label' => 'Theme',
        'plural_label' => 'Themes',
        'navigation_label' => 'Themes',
        'navigation_group' => 'System',
    ],

    'fields' => [
        'name' => [
            'label' => 'Name',
        ],
        'slug' => [
            'label' => 'Slug',
        ],
        'version' => [
            'label' => 'Version',
        ],
        'status' => [
            'label' => 'Status',
        ],
        'parent' => [
            'label' => 'Parent Theme',
        ],
        'authors' => [
            'label' => 'Authors',
        ],
        'assets' => [
            'label' => 'Assets',
        ],
        'file' => [
            'label' => 'Theme Package (ZIP)',
        ],
        'url' => [
            'label' => 'Remote URL',
        ],
        'git_repo' => [
            'label' => 'Git Repository',
        ],
        'local_path' => [
            'label' => 'Local Path',
        ],
        'source_type' => [
            'label' => 'Installation Source',
        ],
        'activate_after_install' => [
            'label' => 'Activate theme after installation',
        ],
        'description' => [
            'label' => 'Description',
        ],
        'path' => [
            'label' => 'Theme Path',
        ],
        'asset_path' => [
            'label' => 'Asset Path',
        ],
        'has_provider' => [
            'label' => 'Theme Service Provider',
        ],
        'screenshot' => [
            'label' => 'Screenshot',
        ],
    ],

    'actions' => [
        'activate' => [
            'label' => 'Activate',
        ],
        'view' => [
            'label' => 'Inspect',
        ],
        'backup' => [
            'label' => 'Backup',
        ],
        'restore' => [
            'label' => 'Restore Latest',
        ],
        'publish_assets' => [
            'label' => 'Publish Assets',
        ],
        'delete' => [
            'label' => 'Delete',
        ],
        'install' => [
            'label' => 'Install Theme',
        ],
        'clear_cache' => [
            'label' => 'Clear Theme Cache',
        ],
        'preview' => [
            'label' => 'Preview',
        ],
    ],

    'bulk_actions' => [
        'publish_assets' => 'Publish Assets',
        'backup' => 'Create Backups',
        'delete' => 'Delete Themes',
    ],

    'notifications' => [
        'activated' => 'Theme activated successfully.',
        'backed_up' => 'Theme backup created successfully.',
        'restored' => 'Theme restored from backup successfully.',
        'assets_published' => 'Theme assets published successfully.',
        'deleted' => 'Theme deleted successfully.',
        'installed' => 'Theme installed successfully.',
        'preview_started' => 'Theme preview started. You can now see the theme in action.',
        'cache_cleared' => 'Theme cache cleared successfully.',
        'bulk_assets_published' => ':count themes assets published.',
        'bulk_backed_up' => ':count themes backed up.',
        'bulk_deleted' => ':count themes deleted.',
    ],

    'options' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
        'none' => 'None',
        'yes' => 'Yes',
        'no' => 'No',
        'sources' => [
            'zip' => 'Upload ZIP File',
            'url' => 'Download from URL',
            'git' => 'Clone Git Repository',
            'local' => 'Local Path',
        ],
    ],

    'errors' => [
        'unexpected_error' => 'An unexpected error occurred.',
        'installation_failed' => 'Theme installation failed.',
        'not_found' => 'Theme [:name] not found.',
        'already_active' => 'Theme [:name] is already active.',
        'publish_failed' => 'Failed to publish assets for theme [:name].',
        'delete_failed' => 'Failed to delete theme [:name].',
        'active_cannot_delete' => 'Cannot delete the active theme.',
        'unknown_author' => 'Unknown Author',
        'no_backup_found' => 'No backup found for theme [:name].',
        'no_description' => 'No description provided.',
        'default_cannot_delete' => 'The default theme cannot be deleted.',
        'parent_cannot_delete' => 'Theme cannot be deleted because other themes depend on it.',
        'operations' => [
            'not_found' => 'The requested theme could not be found.',
            'backup_failed' => 'Failed to create backup for theme [:name]: :reason',
            'restore_failed' => 'Failed to restore theme [:name]: :reason',
            'delete_failed' => 'Failed to delete theme [:name]: :reason',
            'activation_failed' => 'Failed to activate theme [:name]: :reason',
        ],
    ],

    'sections' => [
        'identity' => [
            'label' => 'Identity & Versioning',
        ],
        'architecture' => [
            'label' => 'Architecture & Features',
        ],
        'paths' => [
            'label' => 'Paths & Configuration',
        ],
    ],

    'widgets' => [
        'stats' => [
            'total' => [
                'label' => 'Total Themes',
                'description' => 'Installed themes in the system',
            ],
            'active' => [
                'label' => 'Active Theme',
                'description' => 'Theme currently providing views',
            ],
            'parents' => [
                'label' => 'Child Themes',
                'description' => 'Themes inheriting from others',
            ],
        ],
        'recent' => [
            'heading' => 'Recent Themes',
        ],
    ],

    'filters' => [
        'status' => [
            'label' => 'Status',
            'active' => 'Active',
            'inactive' => 'Inactive',
            'all' => 'All Statuses',
        ],
        'has_parent' => 'Has Parent Theme',
        'has_views' => 'Has Custom Views',
        'has_livewire' => 'Has Livewire Components',
        'has_translations' => 'Has Translations',
    ],

    'backups' => [
        'title' => 'Theme Backups',
        'fields' => [
            'filename' => 'Filename',
            'size' => 'Size',
            'date' => 'Created At',
        ],
        'actions' => [
            'restore' => [
                'label' => 'Restore',
            ],
            'delete' => [
                'label' => 'Delete',
            ],
            'delete_bulk' => [
                'label' => 'Delete Selected',
            ],
        ],
        'notifications' => [
            'deleted' => 'Backup deleted successfully.',
            'bulk_deleted' => 'Selected backups deleted.',
        ],
        'empty' => [
            'heading' => 'No backups available',
            'description' => 'Create your first backup to see it here.',
        ],
    ],
];
