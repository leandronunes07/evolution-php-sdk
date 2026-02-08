<?php

namespace LeandroNunes\Evolution\Resources\Integrations\Events;

use LeandroNunes\Evolution\Resources\BaseResource;

class Pusher extends BaseResource
{
    public function set(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "pusher/set/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "pusher/find/{$instance}");
    }
}
