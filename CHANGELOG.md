# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

- **[BC BREAK]** Remove `symfony/messenger` implementations
- **[BC BREAK]** Change name of the bus main method

## [2.0.0] - 2021-01-12

### Changed
- **[BC BREAK]** Bump minimal PHP to version 8.*
- Use constructor property promotion
- Check the return type in  ```MessengerQueryBus```
- Remove obsolete ```get_class``` from exceptions

[Unreleased]: https://github.com/Tuzex/cqrs/releases/tag/v2.0.0...HEAD
[2.0.0]: https://github.com/Tuzex/cqrs/releases/tag/v2.0.0
