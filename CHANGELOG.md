# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2024-02-08

### Added
- Initial release of the Evolution API PHP SDK.
- Support for **Evolution API v2**.
- **Instances**: Create, connect, delete, restart, and logout.
- **Messages**: Send Text, Media, Audio, and Templates using **DTOs** for type safety.
- **Groups**: Create, update, manage participants, and settings.
- **Integrations**: Support for Typebot, OpenAI, Dify, Flowise, N8N.
- **Webhooks**: `WebhookHandler` class and `WebhookEventDTO` for parsing incoming events.
- **Logging**: PSR-3 `LoggerInterface` support in `Config` and `HttpClient`.
- **S3**: Methods to retrieve media URLs from storage.

### Security
- **Authentication**: Native support for Global API Key and Instance API Key overriding.
- **Validation**: Strict typing and DTOs to prevent malformed requests.

### Standards
- **PSR-12**: Codebase compliant with PHP Framework Interop Group coding standards.
- **Tests**: Comprehensive unit test suite covering DTOs, Webhooks, and Logging.
