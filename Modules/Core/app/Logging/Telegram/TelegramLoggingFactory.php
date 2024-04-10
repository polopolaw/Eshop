<?php

declare(strict_types=1);

namespace Ecom\Core\Logging\Telegram;

use Monolog\Logger;

final class TelegramLoggingFactory
{
    public function __invoke(array $config): Logger
    {
        $logger = new Logger('telegram');
        $logger->setHandlers([new TelegramLoggingHandler($config)]);

        return $logger;
    }
}
