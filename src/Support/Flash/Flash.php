<?php

declare(strict_types=1);

namespace Support\Flash;

use Illuminate\Contracts\Session\Session;

class Flash
{
    public const MESSAGE_KEY = 'core_flash_message';

    public function __construct(protected Session $session)
    {
    }

    public function get(): ?FlashMessage
    {
        $flash = $this->session->get(self::MESSAGE_KEY);
        return $flash ? new FlashMessage($flash['message'], $flash['class']) : null;
    }

    public function info(string $message): void
    {
        $this->flash('info', $message);
    }

    public function alert($message): void
    {
        $this->flash('alert', $message);
    }

    private function flash(string $type, string $message): void
    {
        $this->session->flash(self::MESSAGE_KEY, [
            'message' => $message,
            'class' => config("flash.$type", '')
        ]);
    }
}
