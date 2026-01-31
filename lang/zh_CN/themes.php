<?php

declare(strict_types=1);

return [
    'resource' => [
        'label' => '主题',
        'plural_label' => '主题',
        'navigation_label' => '主题',
        'navigation_group' => '系统',
    ],

    'fields' => [
        'name' => [
            'label' => '名称',
        ],
        'slug' => [
            'label' => '标识符',
        ],
        'version' => [
            'label' => '版本',
        ],
        'status' => [
            'label' => '状态',
        ],
        'parent' => [
            'label' => '父主题',
        ],
        'authors' => [
            'label' => '作者',
        ],
        'assets' => [
            'label' => '资源',
        ],
        'file' => [
            'label' => '主题包 (ZIP)',
        ],
        'url' => [
            'label' => '远程 URL',
        ],
        'git_repo' => [
            'label' => 'Git 仓库',
        ],
        'local_path' => [
            'label' => '本地路径',
        ],
        'source_type' => [
            'label' => '安装来源',
        ],
        'activate_after_install' => [
            'label' => '安装后激活主题',
        ],
        'description' => [
            'label' => '描述',
        ],
        'path' => [
            'label' => '主题路径',
        ],
        'asset_path' => [
            'label' => '资源路径',
        ],
        'has_provider' => [
            'label' => '主题服务提供者',
        ],
    ],

    'actions' => [
        'activate' => [
            'label' => '激活',
        ],
        'view' => [
            'label' => '查看详情',
        ],
        'backup' => [
            'label' => '备份',
        ],
        'restore' => [
            'label' => '还原最新备份',
        ],
        'publish_assets' => [
            'label' => '发布资源',
        ],
        'delete' => [
            'label' => '删除',
        ],
        'install' => [
            'label' => '安装主题',
        ],
        'clear_cache' => [
            'label' => '清除主题缓存',
        ],
    ],

    'bulk_actions' => [
        'publish_assets' => '发布资源',
        'backup' => '创建备份',
        'delete' => '删除主题',
    ],

    'notifications' => [
        'activated' => '主题激活成功。',
        'backed_up' => '主题备份创建成功。',
        'restored' => '主题从备份还原成功。',
        'assets_published' => '主题资源发布成功。',
        'deleted' => '主题删除成功。',
        'installed' => '主题安装成功。',
        'cache_cleared' => '主题缓存已清除。',
        'bulk_assets_published' => ':count 个主题资源已发布。',
        'bulk_backed_up' => ':count 个主题已备份。',
        'bulk_deleted' => ':count 个主题已删除。',
    ],

    'options' => [
        'active' => '已激活',
        'inactive' => '未激活',
        'none' => '无',
        'yes' => '是',
        'no' => '否',
        'sources' => [
            'zip' => '上传 ZIP 文件',
            'url' => '从 URL 下载',
            'git' => '克隆 Git 仓库',
            'local' => '本地路径',
        ],
    ],

    'errors' => [
        'unexpected_error' => '发生意外错误。',
        'installation_failed' => '主题安装失败。',
        'not_found' => '未找到主题 [:name]。',
        'already_active' => '主题 [:name] 已处于激活状态。',
        'publish_failed' => '为主题 [:name] 发布资源失败。',
        'delete_failed' => '删除主题 [:name] 失败。',
        'active_cannot_delete' => '不能删除当前激活的主题。',
        'unknown_author' => '未知作者',
        'no_backup_found' => '未找到主题 [:name] 的备份。',
    ],

    'sections' => [
        'identity' => [
            'label' => '标识与版本',
        ],
        'architecture' => [
            'label' => '架构与特性',
        ],
        'paths' => [
            'label' => '路径与配置',
        ],
    ],

    'widgets' => [
        'stats' => [
            'total' => [
                'label' => '主题总数',
                'description' => '系统中安装的主题数量',
            ],
            'active' => [
                'label' => '当前主题',
                'description' => '当前提供视图的主题',
            ],
            'parents' => [
                'label' => '子主题',
                'description' => '继承自其他主题的主题',
            ],
        ],
        'recent' => [
            'heading' => '最近的主题',
        ],
    ],

    'filters' => [
        'status' => [
            'label' => '状态',
            'active' => '已激活',
            'inactive' => '未激活',
            'all' => '全部状态',
        ],
        'has_parent' => '有父主题',
        'has_views' => '有自定义视图',
        'has_livewire' => '有 Livewire 组件',
        'has_translations' => '有翻译文件',
    ],

    'backups' => [
        'title' => '主题备份',
        'fields' => [
            'filename' => '文件名',
            'size' => '大小',
            'date' => '创建于',
        ],
        'actions' => [
            'restore' => [
                'label' => '还原',
            ],
            'delete' => [
                'label' => '删除',
            ],
            'delete_bulk' => [
                'label' => '删除选中项',
            ],
        ],
        'notifications' => [
            'deleted' => '备份删除成功。',
            'bulk_deleted' => '选中的备份已删除。',
        ],
        'empty' => [
            'heading' => '没有可用备份',
            'description' => '创建您的第一个备份，将其显示在此处。',
        ],
    ],
];
