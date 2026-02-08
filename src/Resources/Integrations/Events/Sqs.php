<?php

namespace LeandroNunes\Evolution\Resources\Integrations\Events;

use LeandroNunes\Evolution\Resources\BaseResource;

class Sqs extends BaseResource
{
    public function set(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "sqs/set/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "sqs/find/{$instance}");
    }
}
