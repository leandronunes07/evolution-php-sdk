<?php

require_once __DIR__ . '/../vendor/autoload.php';

use LeandroNunes\Evolution\Config;
use LeandroNunes\Evolution\DTO\Message\MediaMessageDTO;
use LeandroNunes\Evolution\DTO\Message\TextMessageDTO;
use LeandroNunes\Evolution\EvolutionClient;

$config = new Config(
    baseUrl: 'https://api.example.com',
    globalApiKey: 'your-global-api-key'
);

$client = new EvolutionClient($config);

// Sending Text with DTO
$textMessage = new TextMessageDTO(
    number: '5511999999999',
    text: 'Hello from DTO!',
    delay: 1500
);

try {
    $response = $client->messages()->sendText('instanceName', $textMessage);
    print_r($response);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Sending Media with DTO
$mediaMessage = new MediaMessageDTO(
    number: '5511999999999',
    media: 'https://example.com/image.png',
    mediatype: 'image',
    mimetype: 'image/png',
    fileName: 'image.png',
    caption: 'Cool image!'
);

try {
    $response = $client->messages()->sendMedia('instanceName', $mediaMessage);
    print_r($response);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
