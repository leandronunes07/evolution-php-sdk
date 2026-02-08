<?php

namespace LeandroNunes\Evolution\Tests\Unit;

use LeandroNunes\Evolution\Config;
use LeandroNunes\Evolution\EvolutionClient;
use LeandroNunes\Evolution\Resources\Instance;
use PHPUnit\Framework\TestCase;

class EvolutionClientTest extends TestCase
{
    public function testCanInstantiateClient()
    {
        $config = new Config('https://api.example.com', 'apikey');
        $client = new EvolutionClient($config);

        $this->assertInstanceOf(EvolutionClient::class, $client);
    }

    public function testCanAccessResources()
    {
        $config = new Config('https://api.example.com', 'apikey');
        $client = new EvolutionClient($config);

        $this->assertInstanceOf(Instance::class, $client->instances());
    }
}
