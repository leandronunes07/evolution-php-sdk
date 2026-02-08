<?php

namespace LeandroNunes\Evolution\Resources;

class Message extends BaseResource
{
    public function sendText(string $instance, \LeandroNunes\Evolution\DTO\Message\TextMessageDTO $data): array
    {
        return $this->httpClient->request('POST', "message/sendText/{$instance}", ['json' => $data->toArray()]);
    }

    public function sendMedia(string $instance, \LeandroNunes\Evolution\DTO\Message\MediaMessageDTO $data): array
    {
        return $this->httpClient->request('POST', "message/sendMedia/{$instance}", ['json' => $data->toArray()]);
    }

    public function sendTemplate(string $instance, \LeandroNunes\Evolution\DTO\Message\TemplateMessageDTO $data): array
    {
        return $this->httpClient->request('POST', "message/sendTemplate/{$instance}", ['json' => $data->toArray()]);
    }

    // ... (Other methods abbreviated for conciseness but would be implemented similarly)
}
