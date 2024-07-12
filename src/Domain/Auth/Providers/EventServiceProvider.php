<?php

declare(strict_types=1);

namespace Domain\Auth\Providers;

use App\Listeners\GreetingNewUserListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            GreetingNewUserListener::class
        ]
    ];
}
