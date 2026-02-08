<?php

namespace LeandroNunes\Evolution\DTO\Message;

use LeandroNunes\Evolution\DTO\DTO;

class TextMessageDTO extends DTO
{
    public function __construct(
        public string $number,
        public string $text,
        public int $delay = 1200,
        public bool $linkPreview = true,
        public ?string $quoted = null,
        public ?array $mentions = null
    ) {
    }
}
