<?php

declare(strict_types=1);

return [
    'resource' => [
        'label' => 'Theme',
        'plural_label' => 'Themen',
        'navigation_label' => 'Themen',
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
            'label' => 'Parent-Theme',
        ],
        'authors' => [
            'label' => 'Autoren',
        ],
        'assets' => [
            'label' => 'Assets',
        ],
        'file' => [
            'label' => 'Theme-Paket (ZIP)',
        ],
        'url' => [
            'label' => 'Remote-URL',
        ],
        'git_repo' => [
            'label' => 'Git-Repository',
        ],
        'local_path' => [
            'label' => 'Lokaler Pfad',
        ],
        'source_type' => [
            'label' => 'Installationsquelle',
        ],
        'activate_after_install' => [
            'label' => 'Theme nach der Installation aktivieren',
        ],
        'description' => [
            'label' => 'Beschreibung',
        ],
        'path' => [
            'label' => 'Theme-Pfad',
        ],
        'asset_path' => [
            'label' => 'Asset-Pfad',
        ],
        'has_provider' => [
            'label' => 'Theme Service Provider',
        ],
    ],

    'actions' => [
        'activate' => [
            'label' => 'Aktivieren',
        ],
        'view' => [
            'label' => 'Inspizieren',
        ],
        'backup' => [
            'label' => 'Backup',
        ],
        'restore' => [
            'label' => 'Letztes wiederherstellen',
        ],
        'publish_assets' => [
            'label' => 'Assets veröffentlichen',
        ],
        'delete' => [
            'label' => 'Löschen',
        ],
        'install' => [
            'label' => 'Theme installieren',
        ],
        'clear_cache' => [
            'label' => 'Theme-Cache leeren',
        ],
    ],

    'bulk_actions' => [
        'publish_assets' => 'Assets veröffentlichen',
        'backup' => 'Backups erstellen',
        'delete' => 'Themen löschen',
    ],

    'notifications' => [
        'activated' => 'Theme erfolgreich aktiviert.',
        'backed_up' => 'Theme-Backup erfolgreich erstellt.',
        'restored' => 'Theme erfolgreich aus Backup wiederhergestellt.',
        'assets_published' => 'Theme-Assets erfolgreich veröffentlicht.',
        'deleted' => 'Theme erfolgreich gelöscht.',
        'installed' => 'Theme erfolgreich installiert.',
        'cache_cleared' => 'Theme-Cache erfolgreich geleert.',
        'bulk_assets_published' => ':count Theme-Assets veröffentlicht.',
        'bulk_backed_up' => ':count Themen gesichert.',
        'bulk_deleted' => ':count Themen gelöscht.',
    ],

    'options' => [
        'active' => 'Aktiv',
        'inactive' => 'Inaktiv',
        'none' => 'Keine',
        'yes' => 'Ja',
        'no' => 'Nein',
        'sources' => [
            'zip' => 'ZIP-Datei hochladen',
            'url' => 'Von URL herunterladen',
            'git' => 'Git-Repository klonen',
            'local' => 'Lokaler Pfad',
        ],
    ],

    'errors' => [
        'unexpected_error' => 'Ein unerwarteter Fehler ist aufgetreten.',
        'installation_failed' => 'Theme-Installation fehlgeschlagen.',
        'not_found' => 'Theme [:name] nicht gefunden.',
        'already_active' => 'Theme [:name] ist bereits aktiv.',
        'publish_failed' => 'Assets für Theme [:name] konnten nicht veröffentlicht werden.',
        'delete_failed' => 'Theme [:name] konnte nicht gelöscht werden.',
        'active_cannot_delete' => 'Das aktive Theme kann nicht gelöscht werden.',
        'unknown_author' => 'Unbekannter Autor',
        'no_backup_found' => 'Kein Backup für Theme [:name] gefunden.',
    ],

    'sections' => [
        'identity' => [
            'label' => 'Identität & Versionierung',
        ],
        'architecture' => [
            'label' => 'Architektur & Merkmale',
        ],
        'paths' => [
            'label' => 'Pfade & Konfiguration',
        ],
    ],

    'widgets' => [
        'stats' => [
            'total' => [
                'label' => 'Themen Gesamt',
                'description' => 'Im System installierte Themen',
            ],
            'active' => [
                'label' => 'Aktives Theme',
                'description' => 'Theme, das aktuell Ansichten bereitstellt',
            ],
            'parents' => [
                'label' => 'Child-Themen',
                'description' => 'Themen, die von anderen erben',
            ],
        ],
        'recent' => [
            'heading' => 'Aktuelle Themen',
        ],
    ],

    'filters' => [
        'status' => [
            'label' => 'Status',
            'active' => 'Aktiv',
            'inactive' => 'Inaktiv',
            'all' => 'Alle Status',
        ],
        'has_parent' => 'Hat Parent-Theme',
        'has_views' => 'Hat eigene Ansichten',
        'has_livewire' => 'Hat Livewire-Komponenten',
        'has_translations' => 'Hat Übersetzungen',
    ],

    'backups' => [
        'title' => 'Theme-Backups',
        'fields' => [
            'filename' => 'Dateiname',
            'size' => 'Größe',
            'date' => 'Erstellt am',
        ],
        'actions' => [
            'restore' => [
                'label' => 'Wiederherstellen',
            ],
            'delete' => [
                'label' => 'Löschen',
            ],
            'delete_bulk' => [
                'label' => 'Ausgewählte löschen',
            ],
        ],
        'notifications' => [
            'deleted' => 'Backup erfolgreich gelöscht.',
            'bulk_deleted' => 'Ausgewählte Backups gelöscht.',
        ],
        'empty' => [
            'heading' => 'Keine Backups verfügbar',
            'description' => 'Erstellen Sie Ihr erstes Backup, um es hier zu sehen.',
        ],
    ],
];
