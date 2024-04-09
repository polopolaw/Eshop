<?php

declare(strict_types=1);

namespace Ecom\Core\app\Services\Telegram;

use Ecom\Core\app\Exceptions\Telegram\TelegramApiException;
use Illuminate\Support\Facades\Http;

final class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';

    /**
     * @throws TelegramApiException
     */
    public function message(string $text, string $token, string $chatId)
    {
        $response = Http::get(self::HOST . $token . '/sendMessage', [
            'chat_id' => $chatId,
            'text' => $text
        ]);
        if (in_array('ok', $response->json())) {
            return true;
        }
        throw new TelegramApiException();
    }
}
