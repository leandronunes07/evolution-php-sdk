<?php

namespace LeandroNunes\Evolution\Resources\Integrations\Chatbot;

use LeandroNunes\Evolution\Resources\BaseResource;

class EvoAi extends BaseResource
{
    public function create(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "evoai/create/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "evoai/find/{$instance}");
    }

    public function fetch(string $instance, string $evoaiId): array
    {
        return $this->httpClient->request('GET', "evoai/fetch/{$evoaiId}/{$instance}");
    }

    public function update(string $instance, string $evoaiId, array $data): array
    {
        return $this->httpClient->request('PUT', "evoai/update/{$evoaiId}/{$instance}", ['json' => $data]);
    }

    public function delete(string $instance, string $evoaiId): array
    {
        return $this->httpClient->request('DELETE', "evoai/delete/{$evoaiId}/{$instance}");
    }

    public function changeStatus(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "evoai/changeStatus/{$instance}", ['json' => $data]);
    }

    public function fetchSessions(string $instance, string $evoaiId): array
    {
        return $this->httpClient->request('GET', "evoai/fetchSessions/{$evoaiId}/{$instance}");
    }

    public function setSettings(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "evoai/settings/{$instance}", ['json' => $data]);
    }

    public function fetchSettings(string $instance): array
    {
        return $this->httpClient->request('GET', "evoai/fetchSettings/{$instance}");
    }
}
