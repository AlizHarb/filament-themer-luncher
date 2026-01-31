<?php

declare(strict_types=1);

return [
    'resource' => [
        'label' => 'Tema',
        'plural_label' => 'Temi',
        'navigation_label' => 'Temi',
        'navigation_group' => 'Sistema',
    ],

    'fields' => [
        'name' => [
            'label' => 'Nome',
        ],
        'slug' => [
            'label' => 'Slug',
        ],
        'version' => [
            'label' => 'Versione',
        ],
        'status' => [
            'label' => 'Stato',
        ],
        'parent' => [
            'label' => 'Tema Padre',
        ],
        'authors' => [
            'label' => 'Autori',
        ],
        'assets' => [
            'label' => 'Asset',
        ],
        'file' => [
            'label' => 'Pacchetto Tema (ZIP)',
        ],
        'url' => [
            'label' => 'URL Remoto',
        ],
        'git_repo' => [
            'label' => 'Repository Git',
        ],
        'local_path' => [
            'label' => 'Percorso Locale',
        ],
        'source_type' => [
            'label' => 'Fonte di Installazione',
        ],
        'activate_after_install' => [
            'label' => 'Attiva tema dopo l\'installazione',
        ],
        'description' => [
            'label' => 'Descrizione',
        ],
        'path' => [
            'label' => 'Percorso Tema',
        ],
        'asset_path' => [
            'label' => 'Percorso Asset',
        ],
        'has_provider' => [
            'label' => 'Service Provider del Tema',
        ],
    ],

    'actions' => [
        'activate' => [
            'label' => 'Attiva',
        ],
        'view' => [
            'label' => 'Ispeziona',
        ],
        'backup' => [
            'label' => 'Backup',
        ],
        'restore' => [
            'label' => 'Ripristina Ultimo',
        ],
        'publish_assets' => [
            'label' => 'Pubblica Asset',
        ],
        'delete' => [
            'label' => 'Elimina',
        ],
        'install' => [
            'label' => 'Installa Tema',
        ],
        'clear_cache' => [
            'label' => 'Pulisci Cache Temi',
        ],
    ],

    'bulk_actions' => [
        'publish_assets' => 'Pubblica Asset',
        'backup' => 'Crea Backup',
        'delete' => 'Elimina Temi',
    ],

    'notifications' => [
        'activated' => 'Tema attivato con successo.',
        'backed_up' => 'Backup del tema creato con successo.',
        'restored' => 'Tema ripristinato dal backup con successo.',
        'assets_published' => 'Asset del tema pubblicati con successo.',
        'deleted' => 'Tema eliminato con successo.',
        'installed' => 'Tema installato con successo.',
        'cache_cleared' => 'Cache dei temi pulita con successo.',
        'bulk_assets_published' => ':count asset dei temi pubblicati.',
        'bulk_backed_up' => ':count temi salvati.',
        'bulk_deleted' => ':count temi eliminati.',
    ],

    'options' => [
        'active' => 'Attivo',
        'inactive' => 'Inattivo',
        'none' => 'Nessuno',
        'yes' => 'Sì',
        'no' => 'No',
        'sources' => [
            'zip' => 'Carica file ZIP',
            'url' => 'Scarica da URL',
            'git' => 'Clona repository Git',
            'local' => 'Percorso locale',
        ],
    ],

    'errors' => [
        'unexpected_error' => 'Si è verificato un errore imprevisto.',
        'installation_failed' => 'Installazione del tema fallita.',
        'not_found' => 'Tema [:name] non trovato.',
        'already_active' => 'Il tema [:name] è già attivo.',
        'publish_failed' => 'Impossibile pubblicare gli asset per il tema [:name].',
        'delete_failed' => 'Impossibile eliminare il tema [:name].',
        'active_cannot_delete' => 'Impossibile eliminare il tema attivo.',
        'unknown_author' => 'Autore Sconosciuto',
        'no_backup_found' => 'Nessun backup trovato per il tema [:name].',
    ],

    'sections' => [
        'identity' => [
            'label' => 'Identità e Versionamento',
        ],
        'architecture' => [
            'label' => 'Architettura e Funzionalità',
        ],
        'paths' => [
            'label' => 'Percorsi e Configurazione',
        ],
    ],

    'widgets' => [
        'stats' => [
            'total' => [
                'label' => 'Totale Temi',
                'description' => 'Temi installati nel sistema',
            ],
            'active' => [
                'label' => 'Tema Attivo',
                'description' => 'Tema che fornisce attualmente le viste',
            ],
            'parents' => [
                'label' => 'Temi Figli',
                'description' => 'Temi che ereditano da altri',
            ],
        ],
        'recent' => [
            'heading' => 'Temi Recenti',
        ],
    ],

    'filters' => [
        'status' => [
            'label' => 'Stato',
            'active' => 'Attivo',
            'inactive' => 'Inattivo',
            'all' => 'Tutti gli stati',
        ],
        'has_parent' => 'Ha un Tema Padre',
        'has_views' => 'Ha Viste Personalizzate',
        'has_livewire' => 'Ha Componenti Livewire',
        'has_translations' => 'Ha Traduzioni',
    ],

    'backups' => [
        'title' => 'Backup del Tema',
        'fields' => [
            'filename' => 'Nome file',
            'size' => 'Dimensione',
            'date' => 'Creato il',
        ],
        'actions' => [
            'restore' => [
                'label' => 'Ripristina',
            ],
            'delete' => [
                'label' => 'Elimina',
            ],
            'delete_bulk' => [
                'label' => 'Elimina Selezionati',
            ],
        ],
        'notifications' => [
            'deleted' => 'Backup eliminato con successo.',
            'bulk_deleted' => 'Backup selezionati eliminati.',
        ],
        'empty' => [
            'heading' => 'Nessun backup disponibile',
            'description' => 'Crea il tuo primo backup per vederlo qui.',
        ],
    ],
];
