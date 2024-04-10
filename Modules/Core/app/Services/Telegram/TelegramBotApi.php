<?php

declare(strict_types=1);

namespace Ecom\Core\Services\Telegram;

use Ecom\Core\Exceptions\Telegram\TelegramApiException;
use Illuminate\Support\Facades\Http;
use Throwable;

final class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';

    /**
     * @throws TelegramApiException
     */
    public function message(string $text, string $token, string $chatId)
    {
        try {
            $response = Http::get(self::HOST.$token.'/sendMessage', [
                'chat_id' => $chatId,
                'text' => $text,
            ]);
            if (in_array('ok', $response->json(), true)) {
                return true;
            }
        } catch (Throwable $e) {
            report(throw new TelegramApiException($e->getMessage()));
        }

        return false;
    }
}
