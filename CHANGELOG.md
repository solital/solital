# Released Notes

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