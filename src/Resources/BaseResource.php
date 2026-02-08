<?php

namespace LeandroNunes\Evolution\Resources;

use LeandroNunes\Evolution\HttpClient;

abstract class BaseResource
{
    public function __construct(
        protected HttpClient $httpClient
    ) {
    }
}
