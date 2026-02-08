<?php

namespace LeandroNunes\Evolution\Resources;

class S3 extends BaseResource
{
    public function getMedia(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "s3/getMedia/{$instance}", ['json' => $data]);
    }

    public function getMediaUrl(string $instance, array $data): array
    {
        return $this->httpClient->request('POST', "s3/getMediaUrl/{$instance}", ['json' => $data]);
    }
}
