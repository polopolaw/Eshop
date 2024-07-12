<?php

declare(strict_types=1);

namespace Domain\Catalog\Events\Subscribers;

use Domain\Catalog\Events\Brand\BrandDeletingEvent;
use Domain\Catalog\Events\Brand\BrandSavingEvent;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Cache;

class BrandSubscriber
{
    public function saving(BrandSavingEvent $event): void
    {
        Cache::tags('brand')->flush();
    }

    public function deleting(BrandDeletingEvent $event): void
    {
        Cache::tags('brand')->flush();
    }

    public function subscribe(Dispatcher $dispatcher): array
    {
        return [
            BrandSavingEvent::class => 'saving',
            BrandDeletingEvent::class => 'deleting',
        ];
    }
}
