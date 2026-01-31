<?php

declare(strict_types=1);

return [
    'resource' => [
        'label' => 'テーマ',
        'plural_label' => 'テーマ',
        'navigation_label' => 'テーマ',
        'navigation_group' => 'システム',
    ],

    'fields' => [
        'name' => [
            'label' => '名前',
        ],
        'slug' => [
            'label' => 'スラッグ',
        ],
        'version' => [
            'label' => 'バージョン',
        ],
        'status' => [
            'label' => 'ステータス',
        ],
        'parent' => [
            'label' => '親テーマ',
        ],
        'authors' => [
            'label' => '作者',
        ],
        'assets' => [
            'label' => 'アセット',
        ],
        'file' => [
            'label' => 'テーマパッケージ (ZIP)',
        ],
        'url' => [
            'label' => 'リモート URL',
        ],
        'git_repo' => [
            'label' => 'Git リポジトリ',
        ],
        'local_path' => [
            'label' => 'ローカルパス',
        ],
        'source_type' => [
            'label' => 'インストールソース',
        ],
        'activate_after_install' => [
            'label' => 'インストール後にテーマを有効化する',
        ],
        'description' => [
            'label' => '説明',
        ],
        'path' => [
            'label' => 'テーマパス',
        ],
        'asset_path' => [
            'label' => 'アセットパス',
        ],
        'has_provider' => [
            'label' => 'テーマサービスプロバイダー',
        ],
    ],

    'actions' => [
        'activate' => [
            'label' => '有効化',
        ],
        'view' => [
            'label' => '詳細表示',
        ],
        'backup' => [
            'label' => 'バックアップ',
        ],
        'restore' => [
            'label' => '最新を復元',
        ],
        'publish_assets' => [
            'label' => 'アセットを公開',
        ],
        'delete' => [
            'label' => '削除',
        ],
        'install' => [
            'label' => 'テーマをインストール',
        ],
        'clear_cache' => [
            'label' => 'テーマキャッシュをクリア',
        ],
    ],

    'bulk_actions' => [
        'publish_assets' => 'アセットを公開',
        'backup' => 'バックアップを作成',
        'delete' => 'テーマを削除',
    ],

    'notifications' => [
        'activated' => 'テーマが正常に有効化されました。',
        'backed_up' => 'テーマのバックアップが正常に作成されました。',
        'restored' => 'テーマがバックアップから正常に復元されました。',
        'assets_published' => 'テーマのアセットが正常に公開されました。',
        'deleted' => 'テーマが正常に削除されました。',
        'installed' => 'テーマが正常にインストールされました。',
        'cache_cleared' => 'テーマキャッシュが正常にクリアされました。',
        'bulk_assets_published' => ':count 個のテーマアセットが公開されました。',
        'bulk_backed_up' => ':count 個のテーマがバックアップされました。',
        'bulk_deleted' => ':count 個のテーマが削除されました。',
    ],

    'options' => [
        'active' => '有効',
        'inactive' => '無効',
        'none' => 'なし',
        'yes' => 'はい',
        'no' => 'いいえ',
        'sources' => [
            'zip' => 'ZIP ファイルをアップロード',
            'url' => 'URL からダウンロード',
            'git' => 'Git リポジトリをクローン',
            'local' => 'ローカルパス',
        ],
    ],

    'errors' => [
        'unexpected_error' => '予期しないエラーが発生しました。',
        'installation_failed' => 'テーマのインストールに失敗しました。',
        'not_found' => 'テーマ [:name] が見つかりません。',
        'already_active' => 'テーマ [:name] は既に有効です。',
        'publish_failed' => 'テーマ [:name] のアセット公開に失敗しました。',
        'delete_failed' => 'テーマ [:name] の削除に失敗しました。',
        'active_cannot_delete' => '有効なテーマは削除できません。',
        'unknown_author' => '不明な作者',
        'no_backup_found' => 'テーマ [:name] のバックアップが見つかりません。',
    ],

    'sections' => [
        'identity' => [
            'label' => 'アイデンティティとバージョン',
        ],
        'architecture' => [
            'label' => 'アーキテクチャと機能',
        ],
        'paths' => [
            'label' => 'パスと設定',
        ],
    ],

    'widgets' => [
        'stats' => [
            'total' => [
                'label' => 'テーマ総数',
                'description' => 'システムにインストールされているテーマ',
            ],
            'active' => [
                'label' => '現在のテーマ',
                'description' => '現在ビューを提供しているテーマ',
            ],
            'parents' => [
                'label' => '子テーマ',
                'description' => '他のテーマから継承しているテーマ',
            ],
        ],
        'recent' => [
            'heading' => '最近のテーマ',
        ],
    ],

    'filters' => [
        'status' => [
            'label' => 'ステータス',
            'active' => '有効',
            'inactive' => '無効',
            'all' => 'すべてのステータス',
        ],
        'has_parent' => '親テーマあり',
        'has_views' => 'カスタムビューあり',
        'has_livewire' => 'Livewire コンポーネントあり',
        'has_translations' => '翻訳あり',
    ],

    'backups' => [
        'title' => 'テーマバックアップ',
        'fields' => [
            'filename' => 'ファイル名',
            'size' => 'サイズ',
            'date' => '作成日',
        ],
        'actions' => [
            'restore' => [
                'label' => '復元',
            ],
            'delete' => [
                'label' => '削除',
            ],
            'delete_bulk' => [
                'label' => '選択項目を削除',
            ],
        ],
        'notifications' => [
            'deleted' => 'バックアップが正常に削除されました。',
            'bulk_deleted' => '選択したバックアップが削除されました。',
        ],
        'empty' => [
            'heading' => 'バックアップなし',
            'description' => '最初のバックアップを作成して、ここに表示します。',
        ],
    ],
];
