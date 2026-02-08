<?php

namespace LeandroNunes\Evolution;

use GuzzleHttp\HandlerStack;
use LeandroNunes\Evolution\Resources\Chat;
use LeandroNunes\Evolution\Resources\Group;
use LeandroNunes\Evolution\Resources\Instance;
use LeandroNunes\Evolution\Resources\Integrations;
use LeandroNunes\Evolution\Resources\Message;
use LeandroNunes\Evolution\Resources\Metrics;
use LeandroNunes\Evolution\Resources\Profile;
use LeandroNunes\Evolution\Resources\S3;
use LeandroNunes\Evolution\Resources\Template;

class EvolutionClient
{
    private HttpClient $httpClient;
    private array $resources = [];

    public function __construct(
        private Config $config,
        ?HandlerStack $handler = null
    ) {
        $this->httpClient = new HttpClient($config, $handler);
    }

    public function instances(): Instance
    {
        return $this->resources['instances'] ??= new Instance($this->httpClient);
    }

    public function messages(): Message
    {
        return $this->resources['messages'] ??= new Message($this->httpClient);
    }

    public function groups(): Group
    {
        return $this->resources['groups'] ??= new Group($this->httpClient);
    }

    public function chats(): Chat
    {
        return $this->resources['chats'] ??= new Chat($this->httpClient);
    }

    public function profile(): Profile
    {
        return $this->resources['profile'] ??= new Profile($this->httpClient);
    }

    public function integrations(): Integrations
    {
        return $this->resources['integrations'] ??= new Integrations($this->httpClient);
    }

    public function metrics(): Metrics
    {
        return $this->resources['metrics'] ??= new Metrics($this->httpClient);
    }

    public function templates(): Template
    {
        return $this->resources['templates'] ??= new Template($this->httpClient);
    }

    public function s3(): S3
    {
        return $this->resources['s3'] ??= new S3($this->httpClient);
    }
}
