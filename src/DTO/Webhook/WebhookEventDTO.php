<?php

namespace LeandroNunes\Evolution\DTO\Webhook;

use LeandroNunes\Evolution\DTO\DTO;

class WebhookEventDTO extends DTO
{
    public function __construct(
        public string $event,
        public string $instance,
        public mixed $data,
        public ?string $date = null,
        public ?string $sender = null,
        public ?string $apikey = null
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            event: $data['event'] ?? 'UNKNOWN',
            instance: $data['instance'] ?? '',
            data: $data['data'] ?? [],
            date: $data['date_time'] ?? null,
            sender: $data['sender'] ?? null,
            apikey: $data['apikey'] ?? null
        );
    }
}
