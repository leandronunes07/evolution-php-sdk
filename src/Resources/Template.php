<?php

namespace LeandroNunes\Evolution\Resources;

class Template extends BaseResource
{
    public function create(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "template/create/{$instance}", ['json' => $data]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "template/find/{$instance}");
    }
}
