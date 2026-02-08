<?php

namespace LeandroNunes\Evolution\Resources\Integrations\Chatbot;

use LeandroNunes\Evolution\Resources\BaseResource;

class Chatwoot extends BaseResource
{
    public function set(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "chatwoot/set/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "chatwoot/find/{$instance}");
    }
}
