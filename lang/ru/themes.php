<?php

declare(strict_types=1);

return [
    'resource' => [
        'label' => 'Тема',
        'plural_label' => 'Темы',
        'navigation_label' => 'Темы',
        'navigation_group' => 'Система',
    ],

    'fields' => [
        'name' => [
            'label' => 'Название',
        ],
        'slug' => [
            'label' => 'Слаг',
        ],
        'version' => [
            'label' => 'Версия',
        ],
        'status' => [
            'label' => 'Статус',
        ],
        'parent' => [
            'label' => 'Родительская тема',
        ],
        'authors' => [
            'label' => 'Авторы',
        ],
        'assets' => [
            'label' => 'Ассеты',
        ],
        'file' => [
            'label' => 'Пакет темы (ZIP)',
        ],
        'url' => [
            'label' => 'Удаленный URL',
        ],
        'git_repo' => [
            'label' => 'Git репозиторий',
        ],
        'local_path' => [
            'label' => 'Локальный путь',
        ],
        'source_type' => [
            'label' => 'Источник установки',
        ],
        'activate_after_install' => [
            'label' => 'Активировать тему после установки',
        ],
        'description' => [
            'label' => 'Описание',
        ],
        'path' => [
            'label' => 'Путь к теме',
        ],
        'asset_path' => [
            'label' => 'Путь к ассетам',
        ],
        'has_provider' => [
            'label' => 'Сервис-провайдер темы',
        ],
    ],

    'actions' => [
        'activate' => [
            'label' => 'Активировать',
        ],
        'view' => [
            'label' => 'Инспектировать',
        ],
        'backup' => [
            'label' => 'Резервная копия',
        ],
        'restore' => [
            'label' => 'Восстановить последнюю',
        ],
        'publish_assets' => [
            'label' => 'Опубликовать ассеты',
        ],
        'delete' => [
            'label' => 'Удалить',
        ],
        'install' => [
            'label' => 'Установить тему',
        ],
        'clear_cache' => [
            'label' => 'Очистить кэш тем',
        ],
    ],

    'bulk_actions' => [
        'publish_assets' => 'Опубликовать ассеты',
        'backup' => 'Создать резервные копии',
        'delete' => 'Удалить темы',
    ],

    'notifications' => [
        'activated' => 'Тема успешно активирована.',
        'backed_up' => 'Резервная копия темы успешно создана.',
        'restored' => 'Тема успешно восстановлена из резервной копии.',
        'assets_published' => 'Ассеты темы успешно опубликованы.',
        'deleted' => 'Тема успешно удалена.',
        'installed' => 'Тема успешно установлена.',
        'cache_cleared' => 'Кэш тем успешно очищен.',
        'bulk_assets_published' => 'Ассеты для :count тем опубликованы.',
        'bulk_backed_up' => 'Резервные копии созданы для :count тем.',
        'bulk_deleted' => ':count тем удалено.',
    ],

    'options' => [
        'active' => 'Активна',
        'inactive' => 'Неактивна',
        'none' => 'Нет',
        'yes' => 'Да',
        'no' => 'Нет',
        'sources' => [
            'zip' => 'Загрузить ZIP-файл',
            'url' => 'Скачать по URL',
            'git' => 'Клонировать Git репозиторий',
            'local' => 'Локальный путь',
        ],
    ],

    'errors' => [
        'unexpected_error' => 'Произошла непредвиденная ошибка.',
        'installation_failed' => 'Установка темы не удалась.',
        'not_found' => 'Тема [:name] не найдена.',
        'already_active' => 'Тема [:name] уже активна.',
        'publish_failed' => 'Не удалось опубликовать ассеты для темы [:name].',
        'delete_failed' => 'Не удалось удалить тему [:name].',
        'active_cannot_delete' => 'Нельзя удалить активную тему.',
        'unknown_author' => 'Неизвестный автор',
        'no_backup_found' => 'Резервная копия для темы [:name] не найдена.',
    ],

    'sections' => [
        'identity' => [
            'label' => 'Идентификация и версии',
        ],
        'architecture' => [
            'label' => 'Архитектура и возможности',
        ],
        'paths' => [
            'label' => 'Пути и конфигурация',
        ],
    ],

    'widgets' => [
        'stats' => [
            'total' => [
                'label' => 'Всего тем',
                'description' => 'Установленные темы в системе',
            ],
            'active' => [
                'label' => 'Активная тема',
                'description' => 'Тема, предоставляющая представления в данный момент',
            ],
            'parents' => [
                'label' => 'Дочерние темы',
                'description' => 'Темы, наследующиеся от других',
            ],
        ],
        'recent' => [
            'heading' => 'Недавние темы',
        ],
    ],

    'filters' => [
        'status' => [
            'label' => 'Статус',
            'active' => 'Активна',
            'inactive' => 'Неактивна',
            'all' => 'Все статусы',
        ],
        'has_parent' => 'Есть родительская тема',
        'has_views' => 'Есть свои представления',
        'has_livewire' => 'Есть компоненты Livewire',
        'has_translations' => 'Есть переводы',
    ],

    'backups' => [
        'title' => 'Резервные копии темы',
        'fields' => [
            'filename' => 'Имя файла',
            'size' => 'Размер',
            'date' => 'Дата создания',
        ],
        'actions' => [
            'restore' => [
                'label' => 'Восстановить',
            ],
            'delete' => [
                'label' => 'Удалить',
            ],
            'delete_bulk' => [
                'label' => 'Удалить выбранные',
            ],
        ],
        'notifications' => [
            'deleted' => 'Резервная копия успешно удалена.',
            'bulk_deleted' => 'Выбранные резервные копии удалены.',
        ],
        'empty' => [
            'heading' => 'Нет доступных резервных копий',
            'description' => 'Создайте свою первую резервную копию, чтобы увидеть ее здесь.',
        ],
    ],
];
