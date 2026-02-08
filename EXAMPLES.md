# Exemplos de Uso - Evolution API PHP SDK

Este documento fornece exemplos práticos de como utilizar todos os recursos do SDK.

## Índice

- [Configuração Inicial](#configuração-inicial)
- [Instâncias](#instâncias)
- [Mensagens (DTOs)](#mensagens)
- [Grupos](#grupos)
- [Chats](#chats)
- [Perfil](#perfil)
- [Integrações (Typebot, OpenAI, etc)](#integrações)
- [Templates](#templates)
- [Storage (S3)](#storage-s3)
- [Recebendo Webhooks (Novo)](#recebendo-webhooks)

---

## Configuração Inicial

```php
use LeandroNunes\Evolution\EvolutionClient;
use LeandroNunes\Evolution\Config;

require 'vendor/autoload.php';

$config = new Config(
    baseUrl: 'https://api.seudominio.com',
    globalApiKey: 'SUA_GLOBAL_API_KEY',
    instanceApiKey: 'OPCIONAL_INSTANCE_KEY' // Apenas para fetchInstances globais
$config = new Config(
    baseUrl: 'https://api.seudominio.com',
    globalApiKey: 'SUA_GLOBAL_API_KEY',
    instanceApiKey: 'OPCIONAL_INSTANCE_KEY', // Apenas para fetchInstances globais
    logger: $myPsr3Logger // Opcional: Instância de LoggerInterface (Monolog, etc)
);

$client = new EvolutionClient($config);
```

### Exemplo com Monolog (opcional)

```php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('evolution');
$log->pushHandler(new StreamHandler('path/to/your.log', Logger::DEBUG));

$config = new Config(
    baseUrl: '...',
    globalApiKey: '...',
    logger: $log
);
```

---

## Instâncias

### Criar Nova Instância
```php
$response = $client->instances()->create(
    instanceName: 'minha-instancia-01',
    token: 'token-seguro-da-instancia',
    number: '5511999999999' // Opcional
);
```

### Consultar Estado da Conexão
```php
$state = $client->instances()->connectionState('minha-instancia-01');
print_r($state);
```

### Gerar QRCode (Connect)
```php
$connect = $client->instances()->connect('minha-instancia-01');
// Retorna base64 ou json com qrcode dependendo da config da API
```

---

## Mensagens

Utilize os **DTOs** para garantir a tipagem correta dos dados.

### Enviar Texto
```php
use LeandroNunes\Evolution\DTO\Message\TextMessageDTO;

$mensagem = new TextMessageDTO(
    number: '5511999999999',
    text: 'Olá! Enviado pelo SDK PHP 🐘',
    delay: 1200 // Delay simulando digitação (ms)
);

$client->messages()->sendText('minha-instancia-01', $mensagem);
```

### Enviar Mídia (Imagem/Vídeo/PDF)
```php
use LeandroNunes\Evolution\DTO\Message\MediaMessageDTO;

$media = new MediaMessageDTO(
    number: '5511999999999',
    media: 'https://example.com/imagem.png', // Ou Base64
    mediatype: 'image',
    mimetype: 'image/png',
    fileName: 'imagem.png',
    caption: 'Confira essa imagem!'
);

$client->messages()->sendMedia('minha-instancia-01', $media);
```

### Enviar Áudio (Ptt)
```php
// O SDK trata o envio de áudio como mídia, mas com ajustes específicos se necessário pela API.
// Geralmente usa-se sendMedia com mediatype='audio' ou sendAudio se implementado especificamente.
// Verifique a classe Message resource.
```

---

## Grupos

### Criar Grupo
```php
$client->groups()->create('minha-instancia-01', [
    'subject' => 'Grupo de Teste',
    'participants' => ['5511999999999']
]);
```

### Listar Participantes
```php
$info = $client->groups()->findGroup('minha-instancia-01', '123456789@g.us');
print_r($info);
```

---

## Integrações

### OpenAI (ChatGPT)
```php
$client->integrations()->openai()->create('minha-instancia-01', [
    'enabled' => true,
    'botType' => 'chat', // ou 'assistant'
    'model' => 'gpt-4',
    'apikey' => 'sk-...'
]);
```

### Typebot
```php
$client->integrations()->typebot()->create('minha-instancia-01', [
    'enabled' => true,
    'url' => 'https://viewer.typebot.io/meu-bot',
    'typebot' => 'nome-do-bot',
    'triggerType' => 'all', // ou 'keyword'
]);
```

### Webhook
```php
$client->integrations()->webhook()->set('minha-instancia-01', [
    'enabled' => true,
    'url' => 'https://meusite.com/webhook',
    'events' => ['MESSAGES_UPSERT', 'MESSAGES_UPDATE']
]);
```

---

## Templates

```php
use LeandroNunes\Evolution\DTO\Message\TemplateMessageDTO;

$template = new TemplateMessageDTO(
    number: '5511999999999',
    name: 'hello_world',
    language: 'en_US'
);

$client->messages()->sendTemplate('minha-instancia-01', $template);
```

---

## Recebendo Webhooks

O SDK fornece um `WebhookHandler` para facilitar o parse dos dados recebidos.

```php
use LeandroNunes\Evolution\WebhookHandler;

// Captura o corpo da requisição (ex: php://input)
$rawJson = file_get_contents('php://input');

$handler = new WebhookHandler();

try {
    $event = $handler->parse($rawJson);
    
    // Acessando propriedades tipadas
    echo "Evento: " . $event->event; // MESSAGES_UPSERT, CONNECTION_UPDATE, etc
    echo "Instância: " . $event->instance;

    // Dados específicos do evento
    if ($event->event === 'MESSAGES_UPSERT') {
        print_r($event->data);
    }
    
} catch (\InvalidArgumentException $e) {
    http_response_code(400); // Bad Request
    echo "Payload inválido";
}
```
