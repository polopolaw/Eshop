<?php

declare(strict_types=1);

namespace Services\Telegram;

use Illuminate\Support\Facades\Http;
use Services\Telegram\Exceptions\TelegramApiException;
use Throwable;

final class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';

    /**
     * @throws TelegramApiException
     */
    public function message(string $text, string $token, string $chatId): bool
    {
        try {
            $response = Http::get(self::HOST . $token . '/sendMessage', [
                'chat_id' => $chatId,
                'text' => $text,
            ]);

            if (in_array('ok', $response->json(), true)) {
                return true;
            }
        } catch (Throwable $e) {
            throw new TelegramApiException($e->getMessage());
        }

        return false;
    }
}
