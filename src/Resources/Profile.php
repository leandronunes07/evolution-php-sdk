<?php

namespace LeandroNunes\Evolution\Resources;

class Profile extends BaseResource
{
    public function fetchProfile(string $instance, string $number): array
    {
        return $this->httpClient->request('POST', "chat/fetchProfile/{$instance}", [
            'json' => ['number' => $number]
        ]);
    }

    // ... other methods
}
