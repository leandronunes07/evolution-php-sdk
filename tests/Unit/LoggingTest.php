<?php

namespace Tests\Unit;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use LeandroNunes\Evolution\Config;
use LeandroNunes\Evolution\EvolutionClient;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class LoggingTest extends TestCase
{
    public function testLogsRequestAndResponse()
    {
        // Mock Logger
        $logger = $this->createMock(LoggerInterface::class);

        // Expect 'info' to be called twice (Request and Response)
        $logger->expects($this->exactly(2))
            ->method('info');

        // Mock Http
        $mock = new MockHandler([
            new Response(200, [], json_encode(['status' => 'ok'])),
        ]);
        $handlerStack = HandlerStack::create($mock);

        $config = new Config(
            baseUrl: 'http://test.com',
            globalApiKey: 'key',
            logger: $logger
        );

        $client = new EvolutionClient($config, $handlerStack);
        $client->instances()->fetchInstances();
    }

    public function testLogsError()
    {
        $logger = $this->createMock(LoggerInterface::class);

        // Expect 'info' (request) and 'error' (exception)
        $logger->expects($this->once())->method('info');
        $logger->expects($this->once())->method('error');

        $mock = new MockHandler([
            new RequestException('Error Communicating with Server', new Request('GET', 'test'), null),
        ]);
        $handlerStack = HandlerStack::create($mock);

        $config = new Config(
            baseUrl: 'http://test.com',
            globalApiKey: 'key',
            logger: $logger
        );

        $client = new EvolutionClient($config, $handlerStack);

        try {
            $client->instances()->fetchInstances();
        } catch (\Exception $e) {
            // ignore
        }
    }
}
