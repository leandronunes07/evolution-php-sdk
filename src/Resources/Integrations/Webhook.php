<?php

namespace LeandroNunes\Evolution\Resources\Integrations;

use LeandroNunes\Evolution\Resources\BaseResource;

class Webhook extends BaseResource
{
    public function set(string $instance, string $url, array $events, bool $enabled = true, array $options = []): array
    {
        $body = array_merge([
            'webhook' => array_merge([
                'enabled' => $enabled,
                'url' => $url,
                'events' => $events,
            ], $options)
        ]);

        return $this->httpClient->request('POST', "webhook/set/{$instance}", ['json' => $body]);
    }

    public function find(string $instance): array
    {
        return $this->httpClient->request('GET', "webhook/find/{$instance}");
    }
}
