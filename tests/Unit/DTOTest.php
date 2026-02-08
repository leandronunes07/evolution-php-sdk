<?php

namespace Tests\Unit;

use LeandroNunes\Evolution\Config;
use LeandroNunes\Evolution\EvolutionClient;
use LeandroNunes\Evolution\DTO\Message\TextMessageDTO;
use LeandroNunes\Evolution\DTO\Message\MediaMessageDTO;
use LeandroNunes\Evolution\DTO\Message\TemplateMessageDTO;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class DTOTest extends TestCase
{
    public function testTextMessageDTO()
    {
        $dto = new TextMessageDTO('5511999999999', 'Hello');
        $array = $dto->toArray();

        $this->assertEquals('5511999999999', $array['number']);
        $this->assertEquals('Hello', $array['text']);
        $this->assertEquals(1200, $array['delay']);
    }

    public function testSendTextWithDTO()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['key' => '123']))
        ]);
        $handlerStack = HandlerStack::create($mock);

        $config = new Config('http://localhost', 'global-key');
        $client = new EvolutionClient($config, $handlerStack);

        $dto = new TextMessageDTO('5511999999999', 'Hello World');
        $response = $client->messages()->sendText('instance', $dto);

        $this->assertEquals(['key' => '123'], $response);
    }

    public function testMediaMessageDTO()
    {
        $dto = new MediaMessageDTO(
            number: '5511999999999',
            media: 'base64...',
            mediatype: 'image',
            mimetype: 'image/png',
            fileName: 'test.png',
            caption: 'Test Caption'
        );
        $array = $dto->toArray();

        $this->assertEquals('image/png', $array['mimetype']);
        $this->assertEquals('Test Caption', $array['caption']);
    }

    public function testSendMediaWithDTO()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['key' => 'media123']))
        ]);
        $handlerStack = HandlerStack::create($mock);

        $config = new Config('http://localhost', 'global-key');
        $client = new EvolutionClient($config, $handlerStack);

        $dto = new MediaMessageDTO(
            number: '5511999999999',
            media: 'base64...',
            mediatype: 'image',
            mimetype: 'image/png',
            fileName: 'test.png'
        );
        $response = $client->messages()->sendMedia('instance', $dto);

        $this->assertEquals(['key' => 'media123'], $response);
    }
}
