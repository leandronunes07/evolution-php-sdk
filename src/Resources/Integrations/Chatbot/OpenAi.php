<?php

namespace LeandroNunes\Evolution\Resources\Integrations\Chatbot;

use LeandroNunes\Evolution\Resources\BaseResource;

class OpenAi extends BaseResource
{
    public function create(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "openai/create/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "openai/find/{$instance}");
    }

    public function fetch(string $instance, string $openaiBotId): array
    {
        return $this->httpClient->request('GET', "openai/fetch/{$openaiBotId}/{$instance}");
    }

    public function update(string $instance, string $openaiBotId, array $data): array
    {
        return $this->httpClient->request('PUT', "openai/update/{$openaiBotId}/{$instance}", ['json' => $data]);
    }

    public function delete(string $instance, string $openaiBotId): array
    {
        return $this->httpClient->request('DELETE', "openai/delete/{$openaiBotId}/{$instance}");
    }

    public function changeStatus(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "openai/changeStatus/{$instance}", ['json' => $data]);
    }

    public function fetchSessions(string $instance, string $openaiBotId): array
    {
        return $this->httpClient->request('GET', "openai/fetchSessions/{$openaiBotId}/{$instance}");
    }

    public function setSettings(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "openai/settings/{$instance}", ['json' => $data]);
    }

    public function fetchSettings(string $instance): array
    {
        return $this->httpClient->request('GET', "openai/fetchSettings/{$instance}");
    }

    public function setCreds(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "openai/creds/{$instance}", ['json' => $data]);
    }

    public function getCreds(string $instance): array
    {
        return $this->httpClient->request('GET', "openai/creds/{$instance}");
    }

    public function deleteCreds(string $instance, string $openaiCredsId): array
    {
        return $this->httpClient->request('DELETE', "openai/creds/{$openaiCredsId}/{$instance}");
    }
}
