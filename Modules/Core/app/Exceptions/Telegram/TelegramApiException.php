<?php

declare(strict_types=1);

namespace Ecom\Core\app\Exceptions\Telegram;

use Exception;

class TelegramApiException extends Exception
{
    public function render()
    {
        return false;
    }
}
