<?php

namespace LeandroNunes\Evolution\Resources\Integrations\Chatbot;

use LeandroNunes\Evolution\Resources\BaseResource;

class Dify extends BaseResource
{
    public function create(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "dify/create/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "dify/find/{$instance}");
    }

    public function fetch(string $instance, string $difyId): array
    {
        return $this->httpClient->request('GET', "dify/fetch/{$difyId}/{$instance}");
    }

    public function update(string $instance, string $difyId, array $data): array
    {
        return $this->httpClient->request('PUT', "dify/update/{$difyId}/{$instance}", ['json' => $data]);
    }

    public function delete(string $instance, string $difyId): array
    {
        return $this->httpClient->request('DELETE', "dify/delete/{$difyId}/{$instance}");
    }

    public function changeStatus(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "dify/changeStatus/{$instance}", ['json' => $data]);
    }

    public function fetchSessions(string $instance, string $difyId): array
    {
        return $this->httpClient->request('GET', "dify/fetchSessions/{$difyId}/{$instance}");
    }

    public function setSettings(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "dify/settings/{$instance}", ['json' => $data]);
    }

    public function fetchSettings(string $instance): array
    {
        return $this->httpClient->request('GET', "dify/fetchSettings/{$instance}");
    }
}
