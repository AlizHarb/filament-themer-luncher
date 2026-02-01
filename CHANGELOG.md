# Changelog

All notable changes to `filament-themer-luncher` will be documented in this file.

## v1.0.1 - 2026-02-01

### Added

- Theme Preview functionality via middleware and session/query parameters.
- "Preview" action added to the Theme Table and View Page.
- Screenshots support for themes with automatic display in Table and Infolist.
- Added `SetPreviewTheme` middleware to the `web` group.
- New localization keys for preview-related actions and fields.

### Changed

- Refactored `ThemeService` to utilize standardized Artisan commands from `laravel-themer` (`theme:activate`, `theme:delete`, `theme:publish`, `theme:cache`).
- Updated `Theme` model to include `screenshots` and `screenshot_url` attributes.
- Improved theme deletion logic by bypassing confirmation when forced.
- Upgraded `laravel-themer` dependency to `^1.2.0`.

### Fixed

- Fixed theme activation logic to correctly handle environment file updates via Artisan command.
- Resolved issue where theme assets were not correctly published on activation in some environments.

## v1.0.0 - 2026-01-30

### Added
- Initial release of Filament Themer Luncher.
- Comprehensive UI for theme management.
- Multi-source theme installation (ZIP, URL, Git, Local).
- Integrated theme backup and restoration system.
- Full localization for 11 languages.
- Stats overview and recent themes dashboard widgets.
- Customizable authorization policies.
- Theme inspection and asset management tools.
