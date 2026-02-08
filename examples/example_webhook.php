<?php

// Example of handling an incoming webhook from Evolution API

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    http_response_code(400);
    exit('Invalid JSON');
}

$event = $data['event'] ?? 'unknown';
$instance = $data['instance'] ?? 'unknown';

file_put_contents('webhook.log', "Received event: $event from $instance\n", FILE_APPEND);

switch ($event) {
    case 'messages.upsert':
        $message = $data['data']['message'] ?? [];
        $remoteJid = $data['data']['key']['remoteJid'] ?? '';

        // Process message...
        break;

    case 'qrcode.updated':
        $qrcode = $data['data']['qrcode'] ?? '';
        // Save QR Code...
        break;
}

http_response_code(200);
