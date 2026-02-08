<?php

namespace LeandroNunes\Evolution\Resources\Integrations\Chatbot;

use LeandroNunes\Evolution\Resources\BaseResource;

class Flowise extends BaseResource
{
    public function create(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "flowise/create/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "flowise/find/{$instance}");
    }

    public function fetch(string $instance, string $flowiseId): array
    {
        return $this->httpClient->request('GET', "flowise/fetch/{$flowiseId}/{$instance}");
    }

    public function update(string $instance, string $flowiseId, array $data): array
    {
        return $this->httpClient->request('PUT', "flowise/update/{$flowiseId}/{$instance}", ['json' => $data]);
    }

    public function delete(string $instance, string $flowiseId): array
    {
        return $this->httpClient->request('DELETE', "flowise/delete/{$flowiseId}/{$instance}");
    }

    public function changeStatus(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "flowise/changeStatus/{$instance}", ['json' => $data]);
    }

    public function fetchSessions(string $instance, string $flowiseId): array
    {
        return $this->httpClient->request('GET', "flowise/fetchSessions/{$flowiseId}/{$instance}");
    }

    public function setSettings(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "flowise/settings/{$instance}", ['json' => $data]);
    }

    public function fetchSettings(string $instance): array
    {
        return $this->httpClient->request('GET', "flowise/fetchSettings/{$instance}");
    }
}
