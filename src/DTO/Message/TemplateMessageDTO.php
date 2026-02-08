<?php

namespace LeandroNunes\Evolution\DTO\Message;

use LeandroNunes\Evolution\DTO\DTO;

class TemplateMessageDTO extends DTO
{
    public function __construct(
        public string $number,
        public string $name,
        public string $language,
        public array $components = [], // Array of template components
        public int $delay = 1200
    ) {
    }
}
