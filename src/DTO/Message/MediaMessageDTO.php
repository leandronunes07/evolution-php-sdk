<?php

namespace LeandroNunes\Evolution\DTO\Message;

use LeandroNunes\Evolution\DTO\DTO;

class MediaMessageDTO extends DTO
{
    public function __construct(
        public string $number,
        public string $media, // Base64 or URL
        public string $mediatype, // image, video, document
        public string $mimetype, // image/png, etc.
        public string $fileName,
        public ?string $caption = null,
        public int $delay = 1200
    ) {
    }
}
