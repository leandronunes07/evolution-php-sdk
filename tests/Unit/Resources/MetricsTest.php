<?php

namespace LeandroNunes\Evolution\Tests\Unit\Resources;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use LeandroNunes\Evolution\Config;
use LeandroNunes\Evolution\EvolutionClient;
use PHPUnit\Framework\TestCase;

class MetricsTest extends TestCase
{
    public function testMetricsUsesBasicAuth()
    {
        $container = [];
        $history = Middleware::history($container);

        $mock = new MockHandler([
            new Response(200, [], json_encode([])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($history);

        $config = new Config(
            baseUrl: 'https://api.example.com',
            globalApiKey: 'global',
            metricsUser: 'admin',
            metricsToken: 'secret'
        );
        $client = new EvolutionClient($config, $handlerStack);

        $client->metrics()->get();

        $this->assertCount(1, $container);
        $request = $container[0]['request'];

        // Assert Authorization Header exists and is Basic
        $this->assertTrue($request->hasHeader('Authorization'));
        $this->assertStringStartsWith('Basic ', $request->getHeaderLine('Authorization'));
        // Decode Basic Auth
        $auth = base64_decode(substr($request->getHeaderLine('Authorization'), 6));
        $this->assertEquals('admin:secret', $auth);
    }
}
