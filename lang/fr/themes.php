<?php

declare(strict_types=1);

return [
    'resource' => [
        'label' => 'Thème',
        'plural_label' => 'Thèmes',
        'navigation_label' => 'Thèmes',
        'navigation_group' => 'Système',
    ],

    'fields' => [
        'name' => [
            'label' => 'Nom',
        ],
        'slug' => [
            'label' => 'Slug',
        ],
        'version' => [
            'label' => 'Version',
        ],
        'status' => [
            'label' => 'Statut',
        ],
        'parent' => [
            'label' => 'Thème parent',
        ],
        'authors' => [
            'label' => 'Auteurs',
        ],
        'assets' => [
            'label' => 'Actifs',
        ],
        'file' => [
            'label' => 'Paquet du thème (ZIP)',
        ],
        'url' => [
            'label' => 'URL distante',
        ],
        'git_repo' => [
            'label' => 'Dépôt Git',
        ],
        'local_path' => [
            'label' => 'Chemin local',
        ],
        'source_type' => [
            'label' => 'Source d\'installation',
        ],
        'activate_after_install' => [
            'label' => 'Activer le thème après l\'installation',
        ],
        'description' => [
            'label' => 'Description',
        ],
        'path' => [
            'label' => 'Chemin du thème',
        ],
        'asset_path' => [
            'label' => 'Chemin des actifs',
        ],
        'has_provider' => [
            'label' => 'Fournisseur de services du thème',
        ],
    ],

    'actions' => [
        'activate' => [
            'label' => 'Activer',
        ],
        'view' => [
            'label' => 'Inspecter',
        ],
        'backup' => [
            'label' => 'Sauvegarder',
        ],
        'restore' => [
            'label' => 'Restaurer la dernière',
        ],
        'publish_assets' => [
            'label' => 'Publier les actifs',
        ],
        'delete' => [
            'label' => 'Supprimer',
        ],
        'install' => [
            'label' => 'Installer le thème',
        ],
        'clear_cache' => [
            'label' => 'Vider le cache des thèmes',
        ],
    ],

    'bulk_actions' => [
        'publish_assets' => 'Publier les actifs',
        'backup' => 'Créer des sauvegardes',
        'delete' => 'Supprimer les thèmes',
    ],

    'notifications' => [
        'activated' => 'Thème activé avec succès.',
        'backed_up' => 'Sauvegarde du thème créée avec succès.',
        'restored' => 'Thème restauré à partir de la sauvegarde avec succès.',
        'assets_published' => 'Actifs du thème publiés avec succès.',
        'deleted' => 'Thème supprimé avec succès.',
        'installed' => 'Thème installé avec succès.',
        'cache_cleared' => 'Cache des thèmes vidé avec succès.',
        'bulk_assets_published' => ':count actifs de thèmes publiés.',
        'bulk_backed_up' => ':count thèmes sauvegardés.',
        'bulk_deleted' => ':count thèmes supprimés.',
    ],

    'options' => [
        'active' => 'Actif',
        'inactive' => 'Inactif',
        'none' => 'Aucun',
        'yes' => 'Oui',
        'no' => 'Non',
        'sources' => [
            'zip' => 'Téléverser un fichier ZIP',
            'url' => 'Télécharger depuis une URL',
            'git' => 'Cloner un dépôt Git',
            'local' => 'Chemin local',
        ],
    ],

    'errors' => [
        'unexpected_error' => 'Une erreur inattendue s\'est produite.',
        'installation_failed' => 'L\'installation du thème a échoué.',
        'not_found' => 'Thème [:name] introuvable.',
        'already_active' => 'Le thème [:name] est déjà actif.',
        'publish_failed' => 'Échec de la publication des actifs pour le thème [:name].',
        'delete_failed' => 'Échec de la suppression du thème [:name].',
        'active_cannot_delete' => 'Impossible de supprimer le thème actif.',
        'unknown_author' => 'Auteur inconnu',
        'no_backup_found' => 'Aucune sauvegarde trouvée pour le thème [:name].',
    ],

    'sections' => [
        'identity' => [
            'label' => 'Identité et Versioning',
        ],
        'architecture' => [
            'label' => 'Architecture et Fonctionnalités',
        ],
        'paths' => [
            'label' => 'Chemins et Configuration',
        ],
    ],

    'widgets' => [
        'stats' => [
            'total' => [
                'label' => 'Total des thèmes',
                'description' => 'Thèmes installés dans le système',
            ],
            'active' => [
                'label' => 'Thème actif',
                'description' => 'Thème fournissant actuellement les vues',
            ],
            'parents' => [
                'label' => 'Thèmes enfants',
                'description' => 'Thèmes héritant d\'autres thèmes',
            ],
        ],
        'recent' => [
            'heading' => 'Thèmes récents',
        ],
    ],

    'filters' => [
        'status' => [
            'label' => 'Statut',
            'active' => 'Actif',
            'inactive' => 'Inactif',
            'all' => 'Tous les statuts',
        ],
        'has_parent' => 'A un thème parent',
        'has_views' => 'A des vues personnalisées',
        'has_livewire' => 'A des composants Livewire',
        'has_translations' => 'A des traductions',
    ],

    'backups' => [
        'title' => 'Sauvegardes du thème',
        'fields' => [
            'filename' => 'Nom du fichier',
            'size' => 'Taille',
            'date' => 'Créée le',
        ],
        'actions' => [
            'restore' => [
                'label' => 'Restaurer',
            ],
            'delete' => [
                'label' => 'Supprimer',
            ],
            'delete_bulk' => [
                'label' => 'Supprimer la sélection',
            ],
        ],
        'notifications' => [
            'deleted' => 'Sauvegarde supprimée avec succès.',
            'bulk_deleted' => 'Sauvegardes sélectionnées supprimées.',
        ],
        'empty' => [
            'heading' => 'Aucune sauvegarde disponible',
            'description' => 'Créez votre première sauvegarde pour la voir ici.',
        ],
    ],
];
