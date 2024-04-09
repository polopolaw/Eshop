<?php

declare(strict_types=1);

namespace Ecom\Core\app\Logging\Telegram;

use Ecom\Core\app\Exceptions\Telegram\TelegramApiException;
use Ecom\Core\app\Services\Telegram\TelegramBotApi;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;

final class TelegramLoggingHandler extends AbstractProcessingHandler
{
    protected string $chatId;

    protected string $token;

    public function __construct(array $config)
    {
        $level = Logger::toMonologLevel($config['level']);
        $this->chatId = config('core.telegram.chat_id');
        $this->token = config('core.telegram.token');
        parent::__construct($level);
    }

    protected function write(LogRecord $record): void
    {
        try {
            (new TelegramBotApi())->message($record->formatted, $this->token, $this->chatId);
        } catch (TelegramApiException $exception) {
            \logger()
                ->error('Something went wrong in Telegram API');
        }
    }
}
