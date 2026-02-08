<?php

namespace LeandroNunes\Evolution\Resources\Integrations\Chatbot;

use LeandroNunes\Evolution\Resources\BaseResource;

class EvolutionBot extends BaseResource
{
    public function create(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "evolutionBot/create/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "evolutionBot/find/{$instance}");
    }

    public function fetch(string $instance, string $evolutionBotId): array
    {
        return $this->httpClient->request('GET', "evolutionBot/fetch/{$evolutionBotId}/{$instance}");
    }

    public function update(string $instance, string $evolutionBotId, array $data): array
    {
        return $this->httpClient->request('PUT', "evolutionBot/update/{$evolutionBotId}/{$instance}", ['json' => $data]);
    }

    public function delete(string $instance, string $evolutionBotId): array
    {
        return $this->httpClient->request('DELETE', "evolutionBot/delete/{$evolutionBotId}/{$instance}");
    }
}
