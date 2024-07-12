<?php

declare(strict_types=1);

namespace Domain\Catalog\Events\Subscribers;

use Domain\Catalog\Events\Category\CategoryDeletingEvent;
use Domain\Catalog\Events\Category\CategorySavingEvent;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Cache;

class CategorySubscriber
{
    public function saving(CategorySavingEvent $event): void
    {
        Cache::tags('category')->flush();
    }

    public function deleting(CategoryDeletingEvent $event): void
    {
        Cache::tags('category')->flush();
    }

    public function subscribe(Dispatcher $dispatcher): array
    {
        return [
            CategorySavingEvent::class => 'saving',
            CategoryDeletingEvent::class => 'deleting',
        ];
    }
}
