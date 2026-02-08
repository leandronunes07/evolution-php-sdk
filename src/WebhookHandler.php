<?php

namespace LeandroNunes\Evolution;

use InvalidArgumentException;
use LeandroNunes\Evolution\DTO\Webhook\WebhookEventDTO;

class WebhookHandler
{
    /**
     * Parses a raw JSON request body or an associative array into a WebhookEventDTO.
     *
     * @param string|array $payload Raw JSON string or associative array
     * @return WebhookEventDTO
     * @throws InvalidArgumentException If JSON is invalid
     */
    public function parse(string|array $payload): WebhookEventDTO
    {
        if (is_string($payload)) {
            $decoded = json_decode($payload, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException("Invalid JSON payload: " . json_last_error_msg());
            }
            $payload = $decoded;
        }

        if (! is_array($payload)) {
            throw new InvalidArgumentException("Payload must be a JSON string or an array.");
        }

        return WebhookEventDTO::fromArray($payload);
    }
}
