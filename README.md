# Evolution API PHP SDK

![PHP Version](https://img.shields.io/badge/php-%3E%3D8.1-blue)
![License](https://img.shields.io/badge/license-MIT-green)
![Version](https://img.shields.io/badge/version-1.0.0-orange)
![Style](https://img.shields.io/badge/code%20style-PSR--12-black)

Unofficial PHP SDK for [Evolution API](https://github.com/EvolutionAPI/evolution-api). Simplify your WhatsApp automations with a robust, object-oriented PHP wrapper.

This SDK provides a fluent and expressive interface to interact with Evolution API v2, supporting multi-instance management, message sending (Text, Media, Templates), group administration, and seamless integrations with AI platforms like OpenAI and Typebot.

## 🌟 About

The **Evolution PHP SDK** was built to standardize integrations with Evolution API in PHP projects. It abstracts the complexity of raw HTTP requests, providing a typed, documented, and easy-to-use codebase. 

Whether you are building a simple chatbot or a complex multi-tenant automation system, this SDK ensures your code remains clean, maintainable, and scalable.

## 👨‍💻 Authors

Developed with ❤️ by **[Agência Taruga](https://www.agenciataruga.com)** and **Leandro Oliveira Nunes**.

- **Leandro Nunes** - *Lead Developer* - [GitHub](https://github.com/leandronunes07)
- **Agência Taruga** - [Website](https://www.agenciataruga.com)

## 🚀 Features

- **Object-Oriented**: Fluid API design (`$client->instances()->create(...)`).
- **Type Safety**: Use of DTOs (Data Transfer Objects) for safer payloads.
- **Full Coverage**: Support for Messages, Groups, Profiles, Chatbots (Typebot, OpenAI, Dify, etc.), and Events.
- **Webhook Handling**: Utility class to parse and process incoming webhook events.
- **Logging**: PSR-3 compatible logging support for debugging requests.
- **Standards**: PSR-12 Compliant code quality.
- **Authentication**: Easy management of Global and Instance API Keys.

## 📦 Installation

Install via Composer:

```bash
composer require leandronunes07/evolution-php-sdk
```

## ⚡ Quick Start

```php
use LeandroNunes\Evolution\EvolutionClient;
use LeandroNunes\Evolution\Config;
use LeandroNunes\Evolution\DTO\Message\TextMessageDTO;

// 1. Setup Configuration
$config = new Config(
    baseUrl: 'https://api.your-evolution-instance.com',
    globalApiKey: 'YOUR-GLOBAL-API-KEY'
);

// 2. Initialize Client
$client = new EvolutionClient($config);

// 3. Send a Message
$message = new TextMessageDTO(
    number: '5511999999999',
    text: 'Hello from PHP SDK! 🐘'
);

$response = $client->messages()->sendText('instanceName', $message);
print_r($response);
```

## 📖 Documentation

- [**Exemplos de Uso (EXAMPLES.md)**](./EXAMPLES.md): Lista completa de exemplos para todos os recursos (Mídia, Grupos, Bots, etc).
- [**Contribuição (CONTRIBUTING.md)**](./CONTRIBUTING.md): Como rodar testes e contribuir.

## 🛠️ Supported Resources

- **Instances**: Create, Connect, Restart, Logout, Delete.
- **Messages**: Text, Media, Audio, Template, Location, Contact.
- **Groups**: Create, Update, Participants, Settings.
- **Integrations**: 
    - **Events**: Webhook, RabbitMQ, SQS, Websocket.
    - **Events**: Webhook, RabbitMQ, SQS, Websocket.
    - **Chatbots**: Typebot, OpenAI, Dify, Flowise, N8N, EvolutionBot.
- **Utilities**: Webhook Handler (Parse incoming events).

## 🧪 Testing

```bash
composer install
./vendor/bin/phpunit
```

## 📄 License

MIT License - Copyright (c) 2024 Agência Taruga - Leandro Oliveira Nunes
