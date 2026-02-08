<?php

namespace Tests\Unit;

use LeandroNunes\Evolution\DTO\Webhook\WebhookEventDTO;
use LeandroNunes\Evolution\WebhookHandler;
use PHPUnit\Framework\TestCase;

class WebhookTest extends TestCase
{
    public function testParseJsonString()
    {
        $json = '{
            "event": "MESSAGES_UPSERT",
            "instance": "instancia-01",
            "data": {"key": "123", "message": "hello"},
            "date_time": "2024-02-08T10:00:00Z",
            "sender": "5511999999999@s.whatsapp.net",
            "apikey": "globalkey"
        }';

        $handler = new WebhookHandler();
        $dto = $handler->parse($json);

        $this->assertInstanceOf(WebhookEventDTO::class, $dto);
        $this->assertEquals('MESSAGES_UPSERT', $dto->event);
        $this->assertEquals('instancia-01', $dto->instance);
        $this->assertEquals('hello', $dto->data['message']);
    }

    public function testParseArray()
    {
        $array = [
            "event" => "CONNECTION_UPDATE",
            "instance" => "instancia-02",
            "data" => ["status" => "open"],
        ];

        $handler = new WebhookHandler();
        $dto = $handler->parse($array);

        $this->assertEquals('CONNECTION_UPDATE', $dto->event);
        $this->assertEquals('open', $dto->data['status']);
    }

    public function testInvalidJson()
    {
        $this->expectException(\InvalidArgumentException::class);
        $handler = new WebhookHandler();
        $handler->parse("{invalid-json}");
    }
}
