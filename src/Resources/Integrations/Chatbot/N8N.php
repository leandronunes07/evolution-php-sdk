<?php

namespace LeandroNunes\Evolution\Resources\Integrations\Chatbot;

use LeandroNunes\Evolution\Resources\BaseResource;

class N8N extends BaseResource
{
    public function create(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "n8n/create/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "n8n/find/{$instance}");
    }

    public function fetch(string $instance, string $n8nId): array
    {
        return $this->httpClient->request('GET', "n8n/fetch/{$n8nId}/{$instance}");
    }

    public function update(string $instance, string $n8nId, array $data): array
    {
        return $this->httpClient->request('PUT', "n8n/update/{$n8nId}/{$instance}", ['json' => $data]);
    }

    public function delete(string $instance, string $n8nId): array
    {
        return $this->httpClient->request('DELETE', "n8n/delete/{$n8nId}/{$instance}");
    }

    public function changeStatus(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "n8n/changeStatus/{$instance}", ['json' => $data]);
    }

    public function fetchSessions(string $instance, string $n8nId): array
    {
        return $this->httpClient->request('GET', "n8n/fetchSessions/{$n8nId}/{$instance}");
    }

    public function setSettings(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "n8n/settings/{$instance}", ['json' => $data]);
    }

    public function fetchSettings(string $instance): array
    {
        return $this->httpClient->request('GET', "n8n/fetchSettings/{$instance}");
    }
}
