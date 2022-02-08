# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [3.1.0] - 2022-02-08

### Changed
- Increase minimal PHP version to 8.0 and higher
- Change `QueryBus` return type

## [3.0.0] - 2022-01-31

### Changed
- **[BC BREAK]** Change name of the bus main method
- **[BC BREAK]** Change ```QueryBus``` return type
- 
### Removed
- **[BC BREAK]** Remove ```symfony/messenger``` implementations

## [2.0.0] - 2021-01-12

### Changed
- **[BC BREAK]** Bump minimal PHP to version 8.*
- Use constructor property promotion
- Check the return type in  ```MessengerQueryBus```
- Remove obsolete ```get_class``` from exceptions

[Unreleased]: https://github.com/Tuzex/cqrs/releases/tag/v3.1.0...HEAD
[3.1.0]: https://github.com/Tuzex/cqrs/releases/tag/v3.1.0
[3.0.0]: https://github.com/Tuzex/cqrs/releases/tag/v3.0.0
[2.0.0]: https://github.com/Tuzex/cqrs/releases/tag/v2.0.0
