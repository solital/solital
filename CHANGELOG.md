# Released Notes

## v0.7.2 - (2020-07-15)

### Added

- Added `pass_hash` and `pass_verify` helpers
- Added `error-file.php` template
- Added `FileSystem` class

### Fixed

- Fixed Vinci did not create a new folder inside the `view` folder
- Fixed comments on the `Session` and `Cookie` class
- Fixed namespace in `Session` and `Cookie`
- Fixed comments and `Use` on the class `Wolf` and` WolfCache`

### Changed

- Changed $_COOKIE global variable to `filter_input`

## v0.7.1 - (2020-07-12)

### Added

- Added PHP version check in Vinci
- Added email recovery class
- Added new classes: `Hash`,` Reset` and `Forgot`
- Added email constant in the `config.php` file

### Changed

- Changed links in the `welcome.php` file
- Changed `Guardian` functions
- Changed email validation for the `Mail` class

### Fixed

- Fixed key verification when expiring in `Hash`

## v0.7.0 - (2020-07-05)

### Added

- Added method to create a standard user in the database
- Added method that configures `db.php` in` vinci`
- Added method that creates table directly from `vinci`

### Changed

- Changed Vinci to version 0.7.0

## v0.6.2 - (2020-07-03)

### Added

- Added creating and removing login structure in Vinci
- Added `query` and `prepare` method in `ORM` class
- Added e-mail change on `Guardian`

## Fixed

- Fixed wrong interface in `ClassLoader`
- Fixed template search outside the view folder in `Wolf`

### Changed

- Changed Vinci to version 0.6.0

## v0.6.1 - (2020-07-02)

### Added

- Added route creation and removal by folder
- Added monolog support
- Added `MONOLOG_DIR` constant to insert log files
- Added `LogFiles` folder

## Fixed

- Fixed Interfaces in `Core` folder

### Changed

- Changed Vinci to version 0.5.0

## v0.6.0 - (2020-06-29)

### Added

- Added templates for exceptions
- Added bridge to Katrina ORM
- Added version 0.2.0 to Katrina ORM in `composer.json`
- Added keywords in `composer.json`
- Added `serverRequest()` method in `helpers.php` to manipule ServerRequest class

### Changed

- Changed Vinci to version 0.4.2

### Removed

- Removed `vinci-mode` link in `welcome.php`

## v0.5.1 - (2020-06-28)

### Added

- Added total support for PSR-16 (Simple Cache)
- Added function `pre()` in `helpers.php`
- Added support for Katrina ORM in pre created `Model`

### Fixed

- Fixed tags and comments in `Cache.php`

### Changed

- Changed `welcome.php`
- Changed `Consumer.php` to `Client.php`

## v0.5.0 - (2020-06-27)

### Added

- Added support for PSR-11 and PSR-19
- Added partial support for PSR-7 and PSR-16

### Fixed

- Fixed PSR-1, PSR-5 and PSR-12
- Fixed Middleware
- Fixed composer bug not autoloading automatically

### Changed

- Changed `verifyComponents()` method to `loadComponents()`
- Changed `getUrl()` method to `getUri()` in the `Request` class and in the classes that extend the same
- Changed phpunit for version 8

### Removed

- Removed support and `php-di` component
- Removed the `Model` name when creating a new model

## v0.4.0 - (2020-06-22)

### Added

- Changed and added `Core` namespace in all classes

## v0.3.4 - (2020-06-20)

### Added

- Create a route through Vinci
- New method `loadFile()` in Wolf

### Fixed

- Load `helpers.php` automatically
- Files in assets

## v0.3.3 - (2020-06-19)

### Added

- Controller and Model folder

### Fixed

- Fixed Vinci constant

## v0.3.2 - (2020-06-19)

### Fixed

- scripts in composer.json

## v0.3.1 - (2020-06-19)

### Fixed

- __DIR__ in index.php

## v0.3.0 - (2020-06-19)

### Added

- Changing Vinci from graphical interface to command line

## v0.2.0 - (2020-05-27)

### Added
- Implementing cache
- Added `extract()` to the Wolf template;
- Added CSS and JS in Vinci.

## v0.1.0 - (2020-05-23)

### Added
- Added `Mail` class;
- CSS and JS in Vinci;
- Added method `verifyComponents()` in `Course` class.

### Fixed
- Return in `Session` and `Cookie` class.