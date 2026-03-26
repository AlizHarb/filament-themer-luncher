<?php

declare(strict_types=1);

return [
    'resource' => [
        'label' => 'ڕووکار',
        'plural_label' => 'ڕووکارەکان',
        'navigation_label' => 'ڕووکارەکان',
        'navigation_group' => 'سیستەم',
    ],
    'fields' => [
        'name' => [
            'label' => 'ناو',
        ],
        'slug' => [
            'label' => 'سلەگ',
        ],
        'version' => [
            'label' => 'وەشان',
        ],
        'status' => [
            'label' => 'دۆخ',
        ],
        'parent' => [
            'label' => 'ڕووکاری سەرەکی',
        ],
        'authors' => [
            'label' => 'نووسەران',
        ],
        'assets' => [
            'label' => 'پێداویستییەکان',
        ],
        'file' => [
            'label' => 'فایلی ڕووکار (ZIP)',
        ],
        'url' => [
            'label' => 'بەستەری دەرەکی',
        ],
        'git_repo' => [
            'label' => 'کۆگای Git',
        ],
        'local_path' => [
            'label' => 'ڕێڕەوی ناوخۆیی',
        ],
        'source_type' => [
            'label' => 'سەرچاوەی دامەزراندن',
        ],
        'activate_after_install' => [
            'label' => 'چالاککردنی ڕووکار دوای دامەزراندن',
        ],
        'description' => [
            'label' => 'وەسف',
        ],
        'path' => [
            'label' => 'ڕێڕەوی ڕووکار',
        ],
        'asset_path' => [
            'label' => 'ڕێڕەوی پێداویستییەکان',
        ],
        'has_provider' => [
            'label' => 'دابینکەری خزمەتگوزاری ڕووکار',
        ],
    ],
    'actions' => [
        'activate' => [
            'label' => 'چالاککردن',
        ],
        'view' => [
            'label' => 'پیشاندان',
        ],
        'backup' => [
            'label' => 'باکئەپ',
        ],
        'restore' => [
            'label' => 'گەڕاندنەوەی نوێترین',
        ],
        'publish_assets' => [
            'label' => 'بڵاوکردنەوەی پێداویستییەکان',
        ],
        'delete' => [
            'label' => 'سڕینەوە',
        ],
        'install' => [
            'label' => 'دامەزراندنی ڕووکار',
        ],
        'clear_cache' => [
            'label' => 'سڕینەوەی کاشی ڕووکارەکان',
        ],
    ],
    'bulk_actions' => [
        'publish_assets' => 'بڵاوکردنەوەی پێداویستییەکان',
        'backup' => 'دروستکردنی باکئەپ',
        'delete' => 'سڕینەوەی ڕووکارەکان',
    ],
    'notifications' => [
        'activated' => 'ڕووکارەکە بە سەرکەوتوویی چالاککرا.',
        'backed_up' => 'باکئەپی ڕووکارەکە بە سەرکەوتوویی دروستکرا.',
        'restored' => 'ڕووکارەکە لە باکئەپەوە بە سەرکەوتوویی گەڕێندرایەوە.',
        'assets_published' => 'پێداویستییەکانی ڕووکارەکە بە سەرکەوتوویی بڵاوکرانەوە.',
        'deleted' => 'ڕووکارەکە بە سەرکەوتوویی سڕایەوە.',
        'installed' => 'ڕووکارەکە بە سەرکەوتوویی دامەزرا.',
        'cache_cleared' => 'کاشی ڕووکارەکان بە سەرکەوتوویی سڕایەوە.',
        'bulk_assets_published' => 'پێداویستییەکانی :count ڕووکار بڵاوکرانەوە.',
        'bulk_backed_up' => 'باکئەپ بۆ :count ڕووکار دروستکرا.',
        'bulk_deleted' => ':count ڕووکار سڕانەوە.',
    ],
    'options' => [
        'active' => 'چالاک',
        'inactive' => 'ناچالاک',
        'none' => 'هیچ',
        'yes' => 'بەڵێ',
        'no' => 'نەخێر',
        'sources' => [
            'zip' => 'بەرزکردنەوەی فایلی ZIP',
            'url' => 'داگرتن لە بەستەرەوە',
            'git' => 'کۆپیکردنی کۆگای Git',
            'local' => 'ڕێڕەوی ناوخۆیی',
        ],
    ],
    'errors' => [
        'unexpected_error' => 'هەڵەیەکی چاوەڕواننەکراو ڕوویدا.',
        'installation_failed' => 'دامەزراندنی ڕووکارەکە شکستی هێنا.',
        'not_found' => 'ڕووکاری [:name] نەدۆزرایەوە.',
        'already_active' => 'ڕووکاری [:name] پێشتر چالاککراوە.',
        'publish_failed' => 'بڵاوکردنەوەی پێداویستییەکانی ڕووکاری [:name] شکستی هێنا.',
        'delete_failed' => 'سڕینەوەی ڕووکاری [:name] شکستی هێنا.',
        'active_cannot_delete' => 'ناکرێت ڕووکارێک بسڕدرێتەوە کە لە ئێستادا چالاکە.',
        'unknown_author' => 'نووسەری نەناسراو',
        'no_backup_found' => 'هیچ باکئەپێک بۆ ڕووکاری [:name] نەدۆزرایەوە.',
    ],
    'sections' => [
        'identity' => [
            'label' => 'پێناسە و وەشانەکان',
        ],
        'architecture' => [
            'label' => 'پێکهاتە و تایبەتمەندییەکان',
        ],
        'paths' => [
            'label' => 'ڕێڕەوەکان و ڕێکخستنەکان',
        ],
    ],
    'widgets' => [
        'stats' => [
            'total' => [
                'label' => 'کۆی گشتی ڕووکارەکان',
                'description' => 'ڕووکارە دامەزراوەکانی سیستەم',
            ],
            'active' => [
                'label' => 'ڕووکاری چالاک',
                'description' => 'ئەو ڕووکارەی کە لە ئێستادا بەکاردێت',
            ],
            'parents' => [
                'label' => 'ڕووکارە لاوەکییەکان',
                'description' => 'ئەو ڕووکارانەی کە لە ڕووکاری ترەوە سەرچاوە دەگرن',
            ],
        ],
        'recent' => [
            'heading' => 'دوایین ڕووکارەکان',
        ],
    ],
    'filters' => [
        'status' => [
            'label' => 'دۆخ',
            'active' => 'چالاک',
            'inactive' => 'ناچالاک',
            'all' => 'هەموو دۆخەکان',
        ],
        'has_parent' => 'ڕووکاری سەرەکی هەیە',
        'has_views' => 'ڕووکاری تایبەتمەندی هەیە',
        'has_livewire' => 'پێکهاتەی Livewire تێدایە',
        'has_translations' => 'وەرگێڕانی تێدایە',
    ],
    'backups' => [
        'title' => 'باکئەپەکانی ڕووکار',
        'fields' => [
            'filename' => 'ناوی فایل',
            'size' => 'قەبارە',
            'date' => 'بەرواری دروستکردن',
        ],
        'actions' => [
            'restore' => [
                'label' => 'گەڕاندنەوە',
            ],
            'delete' => [
                'label' => 'سڕینەوە',
            ],
            'delete_bulk' => [
                'label' => 'سڕینەوەی دیاریکراوەکان',
            ],
        ],
        'notifications' => [
            'deleted' => 'باکئەپەکە بە سەرکەوتوویی سڕایەوە.',
            'bulk_deleted' => 'باکئەپە دیاریکراوەکان سڕانەوە.',
        ],
        'empty' => [
            'heading' => 'هیچ باکئەپێک بەردەست نییە',
            'description' => 'یەکەم باکئەپ دروستبکە بۆ ئەوەی لێرە دەربکەوێت.',
        ],
    ],
];
