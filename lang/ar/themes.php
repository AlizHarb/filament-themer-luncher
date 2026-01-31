<?php

declare(strict_types=1);

return [
    'resource' => [
        'label' => 'قالب',
        'plural_label' => 'القوالب',
        'navigation_label' => 'القوالب',
        'navigation_group' => 'النظام',
    ],

    'fields' => [
        'name' => [
            'label' => 'الاسم',
        ],
        'slug' => [
            'label' => 'المعرف النصي',
        ],
        'version' => [
            'label' => 'الإصدار',
        ],
        'status' => [
            'label' => 'الحالة',
        ],
        'parent' => [
            'label' => 'القالب الأب',
        ],
        'authors' => [
            'label' => 'المؤلفون',
        ],
        'assets' => [
            'label' => 'الأصول',
        ],
        'file' => [
            'label' => 'حزمة القالب (ZIP)',
        ],
        'url' => [
            'label' => 'رابط خارجي',
        ],
        'git_repo' => [
            'label' => 'مستودع Git',
        ],
        'local_path' => [
            'label' => 'المسار المحلي',
        ],
        'source_type' => [
            'label' => 'مصدر التثبيت',
        ],
        'activate_after_install' => [
            'label' => 'تفعيل القالب بعد التثبيت',
        ],
        'description' => [
            'label' => 'الوصف',
        ],
        'path' => [
            'label' => 'مسار القالب',
        ],
        'asset_path' => [
            'label' => 'مسار الأصول',
        ],
        'has_provider' => [
            'label' => 'مزود خدمة القالب',
        ],
    ],

    'actions' => [
        'activate' => [
            'label' => 'تفعيل',
        ],
        'view' => [
            'label' => 'فحص',
        ],
        'backup' => [
            'label' => 'نسخ احتياطي',
        ],
        'restore' => [
            'label' => 'استعادة الأحدث',
        ],
        'publish_assets' => [
            'label' => 'نشر الأصول',
        ],
        'delete' => [
            'label' => 'حذف',
        ],
        'install' => [
            'label' => 'تثبيت قالب',
        ],
        'clear_cache' => [
            'label' => 'مسح ذاكرة التخزين المؤقت للقوالب',
        ],
    ],

    'bulk_actions' => [
        'publish_assets' => 'نشر الأصول',
        'backup' => 'إنشاء نسخ احتياطية',
        'delete' => 'حذف القوالب',
    ],

    'notifications' => [
        'activated' => 'تم تفعيل القالب بنجاح.',
        'backed_up' => 'تم إنشاء نسخة احتياطية للقالب بنجاح.',
        'restored' => 'تمت استعادة القالب من النسخة الاحتياطية بنجاح.',
        'assets_published' => 'تم نشر أصول القالب بنجاح.',
        'deleted' => 'تم حذف القالب بنجاح.',
        'installed' => 'تم تثبيت القالب بنجاح.',
        'cache_cleared' => 'تم مسح ذاكرة التخزين المؤقت للقوالب بنجاح.',
        'bulk_assets_published' => 'تم نشر أصول :count من القوالب.',
        'bulk_backed_up' => 'تم إجراء نسخ احتياطي لـ :count من القوالب.',
        'bulk_deleted' => 'تم حذف :count من القوالب.',
    ],

    'options' => [
        'active' => 'مفعل',
        'inactive' => 'غير مفعل',
        'none' => 'لا يوجد',
        'yes' => 'نعم',
        'no' => 'لا',
        'sources' => [
            'zip' => 'رفع ملف ZIP',
            'url' => 'تحميل من رابط',
            'git' => 'استنساخ مستودع Git',
            'local' => 'مسار محلي',
        ],
    ],

    'errors' => [
        'unexpected_error' => 'حدث خطأ غير متوقع.',
        'installation_failed' => 'فشل تثبيت القالب.',
        'not_found' => 'القالب [:name] غير موجود.',
        'already_active' => 'القالب [:name] مفعل بالفعل.',
        'publish_failed' => 'فشل نشر الأصول للقالب [:name].',
        'delete_failed' => 'فشل حذف القالب [:name].',
        'active_cannot_delete' => 'لا يمكن حذف القالب المفعل حالياً.',
        'unknown_author' => 'مؤلف غير معروف',
        'no_backup_found' => 'لا توجد نسخة احتياطية للقالب [:name].',
    ],

    'sections' => [
        'identity' => [
            'label' => 'الهوية والإصدارات',
        ],
        'architecture' => [
            'label' => 'البنية والمميزات',
        ],
        'paths' => [
            'label' => 'المسارات والإعدادات',
        ],
    ],

    'widgets' => [
        'stats' => [
            'total' => [
                'label' => 'إجمالي القوالب',
                'description' => 'القوالب المثبتة في النظام',
            ],
            'active' => [
                'label' => 'القالب النشط',
                'description' => 'القالب الذي يوفر الواجهات حالياً',
            ],
            'parents' => [
                'label' => 'القوالب التابعة',
                'description' => 'القوالب التي ترث من قوالب أخرى',
            ],
        ],
        'recent' => [
            'heading' => 'القوالب الأخيرة',
        ],
    ],

    'filters' => [
        'status' => [
            'label' => 'الحالة',
            'active' => 'نشط',
            'inactive' => 'غير نشط',
            'all' => 'جميع الحالات',
        ],
        'has_parent' => 'له قالب أب',
        'has_views' => 'يحتوي على واجهات مخصصة',
        'has_livewire' => 'يحتوي على مكونات Livewire',
        'has_translations' => 'يحتوي على ترجمات',
    ],

    'backups' => [
        'title' => 'النسخ الاحتياطية للقالب',
        'fields' => [
            'filename' => 'اسم الملف',
            'size' => 'الحجم',
            'date' => 'تاريخ الإنشاء',
        ],
        'actions' => [
            'restore' => [
                'label' => 'استعادة',
            ],
            'delete' => [
                'label' => 'حذف',
            ],
            'delete_bulk' => [
                'label' => 'حذف المحدد',
            ],
        ],
        'notifications' => [
            'deleted' => 'تم حذف النسخة الاحتياطية بنجاح.',
            'bulk_deleted' => 'تم حذف النسخ الاحتياطية المحددة.',
        ],
        'empty' => [
            'heading' => 'لا توجد نسخ احتياطية متاحة',
            'description' => 'قم بإنشاء أول نسخة احتياطية لتظهر هنا.',
        ],
    ],
];
