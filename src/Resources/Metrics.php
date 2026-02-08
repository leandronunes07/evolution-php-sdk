<?php

namespace LeandroNunes\Evolution\Resources;

class Metrics extends BaseResource
{
    public function get(): array
    {
        return $this->httpClient->request('GET', 'metrics', [
            'auth_type' => 'basic'
        ]);
    }
}
