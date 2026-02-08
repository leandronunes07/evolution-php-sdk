<?php

namespace LeandroNunes\Evolution\Resources\Integrations\Events;

use LeandroNunes\Evolution\Resources\BaseResource;

class Rabbitmq extends BaseResource
{
    public function set(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "rabbitmq/set/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "rabbitmq/find/{$instance}");
    }
}
