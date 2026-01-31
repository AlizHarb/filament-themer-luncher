<?php

declare(strict_types=1);

return [
    'resource' => [
        'label' => 'Thema',
        'plural_label' => 'Thema\'s',
        'navigation_label' => 'Thema\'s',
        'navigation_group' => 'Systeem',
    ],

    'fields' => [
        'name' => [
            'label' => 'Naam',
        ],
        'slug' => [
            'label' => 'Slug',
        ],
        'version' => [
            'label' => 'Versie',
        ],
        'status' => [
            'label' => 'Status',
        ],
        'parent' => [
            'label' => 'Parent Thema',
        ],
        'authors' => [
            'label' => 'Auteurs',
        ],
        'assets' => [
            'label' => 'Assets',
        ],
        'file' => [
            'label' => 'Thema Pakket (ZIP)',
        ],
        'url' => [
            'label' => 'Remote URL',
        ],
        'git_repo' => [
            'label' => 'Git Repository',
        ],
        'local_path' => [
            'label' => 'Lokaal Pad',
        ],
        'source_type' => [
            'label' => 'Installatiebron',
        ],
        'activate_after_install' => [
            'label' => 'Thema activeren na installatie',
        ],
        'description' => [
            'label' => 'Beschrijving',
        ],
        'path' => [
            'label' => 'Thema Pad',
        ],
        'asset_path' => [
            'label' => 'Asset Pad',
        ],
        'has_provider' => [
            'label' => 'Thema Service Provider',
        ],
    ],

    'actions' => [
        'activate' => [
            'label' => 'Activeren',
        ],
        'view' => [
            'label' => 'Inspecteren',
        ],
        'backup' => [
            'label' => 'Back-up',
        ],
        'restore' => [
            'label' => 'Laatste Herstellen',
        ],
        'publish_assets' => [
            'label' => 'Assets Publiceren',
        ],
        'delete' => [
            'label' => 'Verwijderen',
        ],
        'install' => [
            'label' => 'Thema Installeren',
        ],
        'clear_cache' => [
            'label' => 'Thema Cache Wissen',
        ],
    ],

    'bulk_actions' => [
        'publish_assets' => 'Assets Publiceren',
        'backup' => 'Back-ups Maken',
        'delete' => 'Thema\'s Verwijderen',
    ],

    'notifications' => [
        'activated' => 'Thema succesvol geactiveerd.',
        'backed_up' => 'Thema back-up succesvol aangemaakt.',
        'restored' => 'Thema succesvol hersteld van de back-up.',
        'assets_published' => 'Thema assets succesvol gepubliceerd.',
        'deleted' => 'Thema succesvol verwijderd.',
        'installed' => 'Thema succesvol geïnstalleerd.',
        'cache_cleared' => 'Thema cache succesvol gewist.',
        'bulk_assets_published' => ':count thema\'s assets gepubliceerd.',
        'bulk_backed_up' => ':count thema\'s geback-upt.',
        'bulk_deleted' => ':count thema\'s verwijderd.',
    ],

    'options' => [
        'active' => 'Actief',
        'inactive' => 'Inactief',
        'none' => 'Geen',
        'yes' => 'Ja',
        'no' => 'Nee',
        'sources' => [
            'zip' => 'ZIP Bestand Uploaden',
            'url' => 'Downloaden van URL',
            'git' => 'Git Repository Klonen',
            'local' => 'Lokaal Pad',
        ],
    ],

    'errors' => [
        'unexpected_error' => 'Er is een onverwachte fout opgetreden.',
        'installation_failed' => 'Thema installatie mislukt.',
        'not_found' => 'Thema [:name] niet gevonden.',
        'already_active' => 'Thema [:name] is al actief.',
        'publish_failed' => 'Fout bij het publiceren van assets voor thema [:name].',
        'delete_failed' => 'Fout bij het verwijderen van thema [:name].',
        'active_cannot_delete' => 'Kan het actieve thema niet verwijderen.',
        'unknown_author' => 'Onbekende Auteur',
        'no_backup_found' => 'Geen back-up gevonden voor thema [:name].',
    ],

    'sections' => [
        'identity' => [
            'label' => 'Identiteit & Versiebeheer',
        ],
        'architecture' => [
            'label' => 'Architectuur & Kenmerken',
        ],
        'paths' => [
            'label' => 'Paden & Configuratie',
        ],
    ],

    'widgets' => [
        'stats' => [
            'total' => [
                'label' => 'Totaal Thema\'s',
                'description' => 'Geïnstalleerde thema\'s in het systeem',
            ],
            'active' => [
                'label' => 'Actief Thema',
                'description' => 'Thema dat momenteel weergaven levert',
            ],
            'parents' => [
                'label' => 'Child Thema\'s',
                'description' => 'Thema\'s die overerven van anderen',
            ],
        ],
        'recent' => [
            'heading' => 'Recente Thema\'s',
        ],
    ],

    'filters' => [
        'status' => [
            'label' => 'Status',
            'active' => 'Actief',
            'inactive' => 'Inactief',
            'all' => 'Alle Statussen',
        ],
        'has_parent' => 'Heeft Parent Thema',
        'has_views' => 'Heeft Eigen Weergaven',
        'has_livewire' => 'Heeft Livewire Componenten',
        'has_translations' => 'Heeft Vertalingen',
    ],

    'backups' => [
        'title' => 'Thema Back-ups',
        'fields' => [
            'filename' => 'Bestandsnaam',
            'size' => 'Grootte',
            'date' => 'Gemaakt op',
        ],
        'actions' => [
            'restore' => [
                'label' => 'Herstellen',
            ],
            'delete' => [
                'label' => 'Verwijderen',
            ],
            'delete_bulk' => [
                'label' => 'Selectie Verwijderen',
            ],
        ],
        'notifications' => [
            'deleted' => 'Back-up succesvol verwijderd.',
            'bulk_deleted' => 'Geselecteerde back-ups verwijderd.',
        ],
        'empty' => [
            'heading' => 'Geen back-ups beschikbaar',
            'description' => 'Maak je eerste back-up om deze hier te zien.',
        ],
    ],
];
