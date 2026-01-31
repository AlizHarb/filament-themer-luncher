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
            'label' => 'Nome',
        ],
        'slug' => [
            'label' => 'Slug',
        ],
        'version' => [
            'label' => 'Versão',
        ],
        'status' => [
            'label' => 'Estado',
        ],
        'parent' => [
            'label' => 'Tema Pai',
        ],
        'authors' => [
            'label' => 'Autores',
        ],
        'assets' => [
            'label' => 'Ativos',
        ],
        'file' => [
            'label' => 'Pacote do Tema (ZIP)',
        ],
        'url' => [
            'label' => 'URL Remota',
        ],
        'git_repo' => [
            'label' => 'Repositório Git',
        ],
        'local_path' => [
            'label' => 'Caminho Local',
        ],
        'source_type' => [
            'label' => 'Fonte de Instalação',
        ],
        'activate_after_install' => [
            'label' => 'Ativar tema após a instalação',
        ],
        'description' => [
            'label' => 'Descrição',
        ],
        'path' => [
            'label' => 'Caminho do Tema',
        ],
        'asset_path' => [
            'label' => 'Caminho dos Ativos',
        ],
        'has_provider' => [
            'label' => 'Provedor de Serviços do Tema',
        ],
    ],

    'actions' => [
        'activate' => [
            'label' => 'Ativar',
        ],
        'view' => [
            'label' => 'Inspecionar',
        ],
        'backup' => [
            'label' => 'Backup',
        ],
        'restore' => [
            'label' => 'Restaurar Último',
        ],
        'publish_assets' => [
            'label' => 'Publicar Ativos',
        ],
        'delete' => [
            'label' => 'Excluir',
        ],
        'install' => [
            'label' => 'Instalar Tema',
        ],
        'clear_cache' => [
            'label' => 'Limpar Cache de Temas',
        ],
    ],

    'bulk_actions' => [
        'publish_assets' => 'Publicar Ativos',
        'backup' => 'Criar Backups',
        'delete' => 'Excluir Temas',
    ],

    'notifications' => [
        'activated' => 'Tema ativado com sucesso.',
        'backed_up' => 'Backup do tema criado com sucesso.',
        'restored' => 'Tema restaurado do backup com sucesso.',
        'assets_published' => 'Ativos do tema publicados com sucesso.',
        'deleted' => 'Tema excluído com sucesso.',
        'installed' => 'Tema instalado com sucesso.',
        'cache_cleared' => 'Cache de temas limpo com sucesso.',
        'bulk_assets_published' => ':count ativos de temas publicados.',
        'bulk_backed_up' => ':count temas com backup realizado.',
        'bulk_deleted' => ':count temas excluídos.',
    ],

    'options' => [
        'active' => 'Ativo',
        'inactive' => 'Inativo',
        'none' => 'Nenhum',
        'yes' => 'Sim',
        'no' => 'Não',
        'sources' => [
            'zip' => 'Carregar arquivo ZIP',
            'url' => 'Baixar de uma URL',
            'git' => 'Clonar repositório Git',
            'local' => 'Caminho local',
        ],
    ],

    'errors' => [
        'unexpected_error' => 'Ocorreu um erro inesperado.',
        'installation_failed' => 'Falha na instalação do tema.',
        'not_found' => 'Tema [:name] não encontrado.',
        'already_active' => 'O tema [:name] já está ativo.',
        'publish_failed' => 'Falha ao publicar os ativos para o tema [:name].',
        'delete_failed' => 'Falha ao excluir o tema [:name].',
        'active_cannot_delete' => 'Não é possível excluir o tema ativo.',
        'unknown_author' => 'Autor Desconhecido',
        'no_backup_found' => 'Nenhum backup encontrado para o tema [:name].',
    ],

    'sections' => [
        'identity' => [
            'label' => 'Identidade e Versão',
        ],
        'architecture' => [
            'label' => 'Arquitetura e Recursos',
        ],
        'paths' => [
            'label' => 'Caminhos e Configuração',
        ],
    ],

    'widgets' => [
        'stats' => [
            'total' => [
                'label' => 'Total de Temas',
                'description' => 'Temas instalados no sistema',
            ],
            'active' => [
                'label' => 'Tema Ativo',
                'description' => 'Tema que fornece as visualizações no momento',
            ],
            'parents' => [
                'label' => 'Temas Filhos',
                'description' => 'Temas que herdam de outros',
            ],
        ],
        'recent' => [
            'heading' => 'Temas Recentes',
        ],
    ],

    'filters' => [
        'status' => [
            'label' => 'Estado',
            'active' => 'Ativo',
            'inactive' => 'Inativo',
            'all' => 'Todos os estados',
        ],
        'has_parent' => 'Tem Tema Pai',
        'has_views' => 'Tem Visualizações Personalizadas',
        'has_livewire' => 'Tem Componentes Livewire',
        'has_translations' => 'Tem Traduções',
    ],

    'backups' => [
        'title' => 'Backups do Tema',
        'fields' => [
            'filename' => 'Nome do arquivo',
            'size' => 'Tamanho',
            'date' => 'Criado em',
        ],
        'actions' => [
            'restore' => [
                'label' => 'Restaurar',
            ],
            'delete' => [
                'label' => 'Excluir',
            ],
            'delete_bulk' => [
                'label' => 'Excluir Selecionados',
            ],
        ],
        'notifications' => [
            'deleted' => 'Backup excluído com sucesso.',
            'bulk_deleted' => 'Backups selecionados excluídos.',
        ],
        'empty' => [
            'heading' => 'Nenhum backup disponível',
            'description' => 'Crie seu primeiro backup para vê-lo aqui.',
        ],
    ],
];
