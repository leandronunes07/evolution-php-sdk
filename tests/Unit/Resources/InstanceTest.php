<?php

namespace LeandroNunes\Evolution\Tests\Unit\Resources;

use LeandroNunes\Evolution\Config;
use LeandroNunes\Evolution\EvolutionClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Middleware;
use PHPUnit\Framework\TestCase;

class InstanceTest extends TestCase
{
    public function testFetchInstancesUsesOverrideKey()
    {
        $container = [];
        $history = Middleware::history($container);

        $mock = new MockHandler([
            new Response(200, [], json_encode([])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($history);

        // Config with both Global and Instance keys
        $config = new Config(
            baseUrl: 'https://api.example.com',
            globalApiKey: 'global-key',
            instanceApiKey: 'override-key'
        );
        $client = new EvolutionClient($config, $handlerStack);

        $client->instances()->fetchInstances();

        $this->assertCount(1, $container);
        $request = $container[0]['request'];

        // Assert header is the override key
        $this->assertEquals('override-key', $request->getHeaderLine('apikey'));
    }

    public function testFetchInstancesFallsBackToGlobalKey()
    {
        $container = [];
        $history = Middleware::history($container);

        $mock = new MockHandler([
            new Response(200, [], json_encode([])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($history);

        // Config with ONLY Global Key
        $config = new Config(
            baseUrl: 'https://api.example.com',
            globalApiKey: 'global-key'
        );
        $client = new EvolutionClient($config, $handlerStack);

        $client->instances()->fetchInstances();

        $this->assertCount(1, $container);
        $request = $container[0]['request'];

        // Assert header is the global key
        $this->assertEquals('global-key', $request->getHeaderLine('apikey'));
    }

    public function testCreateInstanceUsesGlobalKey()
    {
        $container = [];
        $history = Middleware::history($container);

        $mock = new MockHandler([
            new Response(201, [], json_encode([])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($history);

        $config = new Config('https://api.example.com', 'global-key', 'override-key');
        $client = new EvolutionClient($config, $handlerStack);

        $client->instances()->create('test');

        $this->assertCount(1, $container);
        $request = $container[0]['request'];

        // Assert header is GLOBAL key, NOT override key
        $this->assertEquals('global-key', $request->getHeaderLine('apikey'));
    }
}
