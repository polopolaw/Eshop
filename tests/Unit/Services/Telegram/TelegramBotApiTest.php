<?php

namespace Tests\Unit\Services\Telegram;

use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\TestCase;
use Services\Telegram\TelegramBotApi;

class TelegramBotApiTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_it_send_message_success(): void
    {
        Http::fake();
        $response = Http::post("https://exmple.com");

        $result = (new TelegramBotApi())->message('', '', 1);

        $this->assertTrue($result);
    }
}
