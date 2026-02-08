<?php

namespace LeandroNunes\Evolution\Resources;

use LeandroNunes\Evolution\HttpClient;
use LeandroNunes\Evolution\Resources\Integrations\Chatbot\Chatwoot;
use LeandroNunes\Evolution\Resources\Integrations\Chatbot\Typebot;
use LeandroNunes\Evolution\Resources\Integrations\Chatbot\OpenAi;
use LeandroNunes\Evolution\Resources\Integrations\Chatbot\Dify;
use LeandroNunes\Evolution\Resources\Integrations\Chatbot\Flowise;
use LeandroNunes\Evolution\Resources\Integrations\Chatbot\N8N;
use LeandroNunes\Evolution\Resources\Integrations\Chatbot\EvoAi;
use LeandroNunes\Evolution\Resources\Integrations\Chatbot\EvolutionBot;
use LeandroNunes\Evolution\Resources\Integrations\Webhook;
use LeandroNunes\Evolution\Resources\Integrations\Events\Ws;
use LeandroNunes\Evolution\Resources\Integrations\Events\Rabbitmq;
use LeandroNunes\Evolution\Resources\Integrations\Events\Sqs;
use LeandroNunes\Evolution\Resources\Integrations\Events\Nats;
use LeandroNunes\Evolution\Resources\Integrations\Events\Pusher;

class Integrations extends BaseResource
{
    public function typebot(): Typebot
    {
        return new Typebot($this->httpClient);
    }

    public function chatwoot(): Chatwoot
    {
        return new Chatwoot($this->httpClient);
    }

    public function webhook(): Webhook
    {
        return new Webhook($this->httpClient);
    }

    public function websocket(): Ws
    {
        return new Ws($this->httpClient);
    }

    public function rabbitmq(): Rabbitmq
    {
        return new Rabbitmq($this->httpClient);
    }

    public function sqs(): Sqs
    {
        return new Sqs($this->httpClient);
    }

    public function nats(): Nats
    {
        return new Nats($this->httpClient);
    }

    public function pusher(): Pusher
    {
        return new Pusher($this->httpClient);
    }

    public function evolutionBot(): EvolutionBot
    {
        return new EvolutionBot($this->httpClient);
    }

    public function openai(): OpenAi
    {
        return new OpenAi($this->httpClient);
    }

    public function dify(): Dify
    {
        return new Dify($this->httpClient);
    }

    public function flowise(): Flowise
    {
        return new Flowise($this->httpClient);
    }

    public function n8n(): N8N
    {
        return new N8N($this->httpClient);
    }

    public function evoai(): EvoAi
    {
        return new EvoAi($this->httpClient);
    }
}
