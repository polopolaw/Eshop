<?php

return [
    'name' => 'Core',
    'telegram' => [
        'token' => env('TELEGRAM_LOGGING_BOT_TOKEN'),
        'chat_id' => env('TELEGRAM_LOGGING_CHAT_ID'),
    ]
];