# Filament Themer Luncher 🎨

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alizharb/filament-themer-luncher.svg?style=flat-square)](https://packagist.org/packages/alizharb/filament-themer-luncher)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/alizharb/filament-themer-luncher/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/alizharb/filament-themer-luncher/actions?query=workflow%3ATests+branch%3Amain)
[![GitHub PHPStan Action Status](https://img.shields.io/github/actions/workflow/status/alizharb/filament-themer-luncher/phpstan.yml?branch=main&label=phpstan&style=flat-square)](https://github.com/alizharb/filament-themer-luncher/actions?query=workflow%3APHPStan+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/alizharb/filament-themer-luncher.svg?style=flat-square)](https://packagist.org/packages/alizharb/filament-themer-luncher)
[![Licence](https://img.shields.io/packagist/l/alizharb/filament-themer-luncher.svg?style=flat-square)](https://packagist.org/packages/alizharb/filament-themer-luncher)

**Filament Themer Luncher** is the premium theme management solution for [Laravel Themer](https://github.com/AlizHarb/laravel-themer) applications. Effortlessly manage your system's visual identity directly from your Filament admin panel. Install, activate, backup, and restore themes with a beautiful, professional interface.

## ✨ Features

- 🎨 **Visual Management**: Full-featured Filament resource for themes.
- 🔄 **Live Activation**: Switch between themes instantly with a single click.
- ⬇️ **Multi-Source Installation**: Install themes from:
    - 📂 **Local ZIP Uploads**
    - 🔗 **Direct URLs** (ZIP)
    - 🐙 **Git Repositories** (Private & Public)
    - 📁 **Local Paths**
- 💾 **Safe Backups**: Automated and manual ZIP backups with easy restoration.
- 🔍 **Deep Inspection**: View theme metadata, authors, and feature support (Livewire, Translations, etc.).
- 🌍 **Fully Localized**: Professional translations for 11 languages out of the box.
- 🛠️ **PHP 8.3 & Laravel 12**: Built using the latest modern standards.

---

## 🌍 Ecosystem

Enhance your modular and themeable application with our official packages:

- **[Laravel Themer](https://github.com/AlizHarb/laravel-themer)**: Review the core package documentation.
- **[Filament Modular Luncher](https://github.com/AlizHarb/filament-modular-luncher)**: Advanced module management for Filament.
- **[Laravel Modular](https://github.com/AlizHarb/laravel-modular)**: The core modular architecture package.

---

## 🚀 Installation

Install the package via Composer:

```bash
composer require alizharb/filament-themer-luncher
```

Register the plugin in your Filament Panel Provider:

```php
use AlizHarb\ThemerLuncher\Filament\Plugins\ThemerLuncherPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugin(ThemerLuncherPlugin::make());
}
```

---

## 🔧 Configuration

Publish the configuration file for customization:

```bash
php artisan vendor:publish --tag="themer-luncher-config"
```

### Configuration Options

- **`installation.allowed_sources`**: Control where themes can be installed from.
- **`backups.enabled`**: Enable or disable the backup system.
- **`backups.keep_last`**: Number of backup files to keep per theme.
- **`authorization.enabled`**: Enable permission-based access control.

---

## 📖 Usage

### Installing a Theme

1. Navigate to the **Themes** resource in your admin panel.
2. Click **Install Theme**.
3. Choose your source (ZIP, URL, Git, or Local).
4. Fill in the required details and click **Install**.

### Managing Themes

- **Activate**: Use the "Activate" action to switch the system theme.
- **Backup**: Click "Backup" to create a ZIP snapshot of the theme directory.
- **Restore**: Restore a theme to a previous state from the "Backups" tab.
- **Publish Assets**: Re-publish theme views and public assets.

---

## 💖 Sponsors

We would like to extend our thanks to the following sponsors for funding the development of our ecosystem. If you are interested in becoming a sponsor, please visit the [GitHub Sponsors page](https://github.com/sponsors/alizharb).

---

## 🌟 Acknowledgments

- **Laravel**: For the most elegant PHP framework.
- **Filament**: For the amazing admin panel builder.
- **Spatie**: For leading the way in Laravel package development standards.

---

## 🤝 Contributing

We welcome contributions! Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

---

## 🔒 Security

If you discover any security-related issues, please email **Ali Harb** at [harbzali@gmail.com](mailto:harbzali@gmail.com).

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

---

<p align="center">
    Made with ❤️ by <strong>Ali Harb</strong>
</p>
