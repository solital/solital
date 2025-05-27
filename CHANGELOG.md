# Released Notes

## v4.1.1 - (2025-05-27)

### Changed

- Update license

--------------------------------------------------------------------------

## v4.1.0 - (2024-10-11)

### Changed

- Changed `config.php` autoload file to get `.env` file first

--------------------------------------------------------------------------

## v4.0.4 - (2024-08-14)

### Changed

- Changed `config.php` autoload file

### Removed

- Removed `ERRORS_DISPLAY` environment

--------------------------------------------------------------------------

## v4.0.3 - (2024-04-05)

### Changed

- Changed `vinci` file when no command is passed

--------------------------------------------------------------------------

## v4.0.2 - (2024-03-16)

### Fixed

- Fixed root version at `composer.json`
- Fixed `config.php` file

### Changed

- Changed `.env` file

--------------------------------------------------------------------------

## v4.0.1 - (2024-02-20)

### Added

- Added `.gitattributes` file

### Removed

- Removed config files

--------------------------------------------------------------------------

## v4.0.0 - (2024-01-21)

### Added

- Added PHP 8.3 minimum version
- Added new `welcome` page
- Added `ServiceContainer` class
- Added `exceptions.yaml`, `logger.yaml` and `mail.yaml` files

### Changed

- Changed CSRF on `index.php` and added `Application::loadCsrfVerifier()`
- Changed `MailQueue` and `Config` class
- Changed `bootstrap.yaml`, `database.yaml` and `middleware.yaml` files

### Removed

- Removed `vlucas/phpdotenv` component at `config.php`
- Removed `script.js` on assets
- Removed `PRODUCTION_MODE` and `INDEX_LOGIN` at .env file
- Removed constant `SITE_ROOT` at `vinci` and `index.php` files 

--------------------------------------------------------------------------