<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Notifications\GreetingNewUserNotification;
use Illuminate\Auth\Events\Registered;

class GreetingNewUserListener
{
    public function handle(Registered $event): void
    {
        $event->user->notify(new GreetingNewUserNotification());
    }
}
