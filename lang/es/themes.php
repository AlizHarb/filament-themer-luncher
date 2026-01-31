<?php

declare(strict_types=1);

return [
    'resource' => [
        'label' => 'Tema',
        'plural_label' => 'Temas',
        'navigation_label' => 'Temas',
        'navigation_group' => 'Sistema',
    ],

    'fields' => [
        'name' => [
            'label' => 'Nombre',
        ],
        'slug' => [
            'label' => 'Slug',
        ],
        'version' => [
            'label' => 'Versión',
        ],
        'status' => [
            'label' => 'Estado',
        ],
        'parent' => [
            'label' => 'Tema Padre',
        ],
        'authors' => [
            'label' => 'Autores',
        ],
        'assets' => [
            'label' => 'Activos',
        ],
        'file' => [
            'label' => 'Paquete del Tema (ZIP)',
        ],
        'url' => [
            'label' => 'URL Remota',
        ],
        'git_repo' => [
            'label' => 'Repositorio Git',
        ],
        'local_path' => [
            'label' => 'Ruta Local',
        ],
        'source_type' => [
            'label' => 'Fuente de Instalación',
        ],
        'activate_after_install' => [
            'label' => 'Activar tema tras la instalación',
        ],
        'description' => [
            'label' => 'Descripción',
        ],
        'path' => [
            'label' => 'Ruta del Tema',
        ],
        'asset_path' => [
            'label' => 'Ruta de Activos',
        ],
        'has_provider' => [
            'label' => 'Proveedor de Servicios del Tema',
        ],
    ],

    'actions' => [
        'activate' => [
            'label' => 'Activar',
        ],
        'view' => [
            'label' => 'Inspeccionar',
        ],
        'backup' => [
            'label' => 'Respaldo',
        ],
        'restore' => [
            'label' => 'Restaurar Último',
        ],
        'publish_assets' => [
            'label' => 'Publicar Activos',
        ],
        'delete' => [
            'label' => 'Eliminar',
        ],
        'install' => [
            'label' => 'Instalar Tema',
        ],
        'clear_cache' => [
            'label' => 'Limpiar Caché de Temas',
        ],
    ],

    'bulk_actions' => [
        'publish_assets' => 'Publicar Activos',
        'backup' => 'Crear Respaldos',
        'delete' => 'Eliminar Temas',
    ],

    'notifications' => [
        'activated' => 'Tema activado con éxito.',
        'backed_up' => 'Respaldo del tema creado con éxito.',
        'restored' => 'Tema restaurado desde el respaldo con éxito.',
        'assets_published' => 'Activos del tema publicados con éxito.',
        'deleted' => 'Tema eliminado con éxito.',
        'installed' => 'Tema instalado con éxito.',
        'cache_cleared' => 'Caché de temas limpiada con éxito.',
        'bulk_assets_published' => ':count activos de temas publicados.',
        'bulk_backed_up' => ':count temas respaldados.',
        'bulk_deleted' => ':count temas eliminados.',
    ],

    'options' => [
        'active' => 'Activo',
        'inactive' => 'Inactivo',
        'none' => 'Ninguno',
        'yes' => 'Sí',
        'no' => 'No',
        'sources' => [
            'zip' => 'Subir archivo ZIP',
            'url' => 'Descargar desde URL',
            'git' => 'Clonar repositorio Git',
            'local' => 'Ruta local',
        ],
    ],

    'errors' => [
        'unexpected_error' => 'Ocurrió un error inesperado.',
        'installation_failed' => 'Error al instalar el tema.',
        'not_found' => 'Tema [:name] no encontrado.',
        'already_active' => 'El tema [:name] ya está activo.',
        'publish_failed' => 'Error al publicar los activos del tema [:name].',
        'delete_failed' => 'Error al eliminar el tema [:name].',
        'active_cannot_delete' => 'No se puede eliminar el tema activo.',
        'unknown_author' => 'Autor Desconocido',
        'no_backup_found' => 'No se encontró respaldo para el tema [:name].',
    ],

    'sections' => [
        'identity' => [
            'label' => 'Identidad y Versión',
        ],
        'architecture' => [
            'label' => 'Arquitectura y Características',
        ],
        'paths' => [
            'label' => 'Rutas y Configuración',
        ],
    ],

    'widgets' => [
        'stats' => [
            'total' => [
                'label' => 'Total de Temas',
                'description' => 'Temas instalados en el sistema',
            ],
            'active' => [
                'label' => 'Tema Activo',
                'description' => 'Tema que provee las vistas actualmente',
            ],
            'parents' => [
                'label' => 'Temas Hijos',
                'description' => 'Temas que heredan de otros',
            ],
        ],
        'recent' => [
            'heading' => 'Temas Recientes',
        ],
    ],

    'filters' => [
        'status' => [
            'label' => 'Estado',
            'active' => 'Activo',
            'inactive' => 'Inactivo',
            'all' => 'Todos los estados',
        ],
        'has_parent' => 'Tiene Tema Padre',
        'has_views' => 'Tiene Vistas Personalizadas',
        'has_livewire' => 'Tiene Componentes Livewire',
        'has_translations' => 'Tiene Traducciones',
    ],

    'backups' => [
        'title' => 'Respaldos del Tema',
        'fields' => [
            'filename' => 'Nombre del archivo',
            'size' => 'Tamaño',
            'date' => 'Creado el',
        ],
        'actions' => [
            'restore' => [
                'label' => 'Restaurar',
            ],
            'delete' => [
                'label' => 'Eliminar',
            ],
            'delete_bulk' => [
                'label' => 'Eliminar Seleccionados',
            ],
        ],
        'notifications' => [
            'deleted' => 'Respaldo eliminado con éxito.',
            'bulk_deleted' => 'Respaldos seleccionados eliminados.',
        ],
        'empty' => [
            'heading' => 'No hay respaldos disponibles',
            'description' => 'Crea tu primer respaldo para verlo aquí.',
        ],
    ],
];
