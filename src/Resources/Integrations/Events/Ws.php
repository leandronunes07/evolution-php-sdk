<?php

namespace LeandroNunes\Evolution\Resources\Integrations\Events;

use LeandroNunes\Evolution\Resources\BaseResource;

class Ws extends BaseResource
{
    public function set(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "websocket/set/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "websocket/find/{$instance}");
    }
}
