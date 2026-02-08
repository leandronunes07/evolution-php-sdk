<?php

namespace LeandroNunes\Evolution\Resources\Integrations\Events;

use LeandroNunes\Evolution\Resources\BaseResource;

class Nats extends BaseResource
{
    public function set(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "nats/set/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "nats/find/{$instance}");
    }
}
