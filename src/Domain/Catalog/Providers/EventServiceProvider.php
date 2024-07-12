<?php

declare(strict_types=1);

namespace Domain\Catalog\Providers;

use Domain\Catalog\Events\Subscribers\BrandSubscriber;
use Domain\Catalog\Events\Subscribers\CategorySubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $subscribe = [
        CategorySubscriber::class,
        BrandSubscriber::class
    ];
}
