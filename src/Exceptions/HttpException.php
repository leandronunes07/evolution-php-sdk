<?php

namespace LeandroNunes\Evolution\Exceptions;

class HttpException extends EvolutionException
{
    public function __construct(
        string $message,
        public int $statusCode,
        public mixed $responseBody,
        public ?string $requestId = null,
        public ?string $endpoint = null
    ) {
        parent::__construct($message, $statusCode);
    }
}
