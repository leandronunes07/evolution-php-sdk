<?php

require 'vendor/autoload.php';

use LeandroNunes\Evolution\Config;
use LeandroNunes\Evolution\EvolutionClient;

// 1. Configure the Client
$config = new Config(
    baseUrl: 'https://api.yourdomain.com',
    globalApiKey: 'BSJD73...',
    instanceApiKey: 'optional-override',
    metricsToken: 'metrics-secret'
);

$client = new EvolutionClient($config);

// 2. Instance Management (Plural API)
$client->instances()->fetchInstances();

// 3. Messages
use LeandroNunes\Evolution\DTO\Message\TextMessageDTO;

$dto = new TextMessageDTO(
    number: '5511999999999',
    text: 'Hello World'
);

$client->messages()->sendText('instance', $dto);

// 4. Metrics (Basic Auth)
$client->metrics()->get();
