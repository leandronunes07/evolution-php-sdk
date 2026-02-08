<?php

namespace Tests\Unit;

use LeandroNunes\Evolution\Config;
use LeandroNunes\Evolution\EvolutionClient;
use LeandroNunes\Evolution\Resources\Chat;
use LeandroNunes\Evolution\Resources\Group;
use LeandroNunes\Evolution\Resources\Instance;
use LeandroNunes\Evolution\Resources\Integrations;
use LeandroNunes\Evolution\Resources\Message;
use LeandroNunes\Evolution\Resources\Metrics;
use LeandroNunes\Evolution\Resources\Profile;
use LeandroNunes\Evolution\Resources\S3;
use LeandroNunes\Evolution\Resources\Template;
use PHPUnit\Framework\TestCase;

class IntegrationCoverageTest extends TestCase
{
    public function testClientReturnsCorrectResources()
    {
        $config = new Config('http://localhost', 'global-key');
        $client = new EvolutionClient($config);

        $this->assertInstanceOf(Instance::class, $client->instances());
        $this->assertInstanceOf(Message::class, $client->messages());
        $this->assertInstanceOf(Group::class, $client->groups());
        $this->assertInstanceOf(Chat::class, $client->chats());
        $this->assertInstanceOf(Profile::class, $client->profile());
        $this->assertInstanceOf(Integrations::class, $client->integrations());
        $this->assertInstanceOf(Metrics::class, $client->metrics());
        $this->assertInstanceOf(Template::class, $client->templates());
        $this->assertInstanceOf(S3::class, $client->s3());
    }

    public function testIntegrationsReturnsCorrectSubResources()
    {
        $config = new Config('http://localhost', 'global-key');
        $client = new EvolutionClient($config);
        $integrations = $client->integrations();

        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Chatbot\Typebot::class, $integrations->typebot());
        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Chatbot\Chatwoot::class, $integrations->chatwoot());
        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Chatbot\EvolutionBot::class, $integrations->evolutionBot());
        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Chatbot\OpenAi::class, $integrations->openai());
        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Chatbot\Dify::class, $integrations->dify());
        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Chatbot\Flowise::class, $integrations->flowise());
        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Chatbot\N8N::class, $integrations->n8n());
        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Chatbot\EvoAi::class, $integrations->evoai());

        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Webhook::class, $integrations->webhook());

        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Events\Ws::class, $integrations->websocket());
        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Events\Rabbitmq::class, $integrations->rabbitmq());
        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Events\Sqs::class, $integrations->sqs());
        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Events\Nats::class, $integrations->nats());
        $this->assertInstanceOf(\LeandroNunes\Evolution\Resources\Integrations\Events\Pusher::class, $integrations->pusher());
    }
}
