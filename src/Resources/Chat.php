<?php

namespace LeandroNunes\Evolution\Resources;

class Chat extends BaseResource
{
    public function checkIsWhatsAppNumber(string $instance, array $numbers): array
    {
        return $this->httpClient->request('POST', "chat/whatsappNumbers/{$instance}", [
            'json' => ['numbers' => $numbers]
        ]);
    }

    // ... other methods
}
