<?php

namespace LeandroNunes\Evolution\Resources\Integrations\Chatbot;

use LeandroNunes\Evolution\Resources\BaseResource;

class Typebot extends BaseResource
{
    public function create(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "typebot/create/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "typebot/find/{$instance}");
    }

    public function fetch(string $instance, string $typebotId): array
    {
        return $this->httpClient->request('GET', "typebot/fetch/{$typebotId}/{$instance}");
    }

    public function update(string $instance, string $typebotId, array $data): array
    {
        return $this->httpClient->request('PUT', "typebot/update/{$typebotId}/{$instance}", ['json' => $data]);
    }

    public function delete(string $instance, string $typebotId): array
    {
        return $this->httpClient->request('DELETE', "typebot/delete/{$typebotId}/{$instance}");
    }

    public function start(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "typebot/start/{$instance}", ['json' => $data]);
    }

    public function changeStatus(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "typebot/changeStatus/{$instance}", ['json' => $data]);
    }

    public function fetchSessions(string $instance, string $typebotId): array
    {
        return $this->httpClient->request('GET', "typebot/fetchSessions/{$typebotId}/{$instance}");
    }

    public function setSettings(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "typebot/set/{$instance}", ['json' => $data]);
    }

    public function fetchSettings(string $instance): array
    {
        return $this->httpClient->request('GET', "typebot/fetchSettings/{$instance}");
    }
}
