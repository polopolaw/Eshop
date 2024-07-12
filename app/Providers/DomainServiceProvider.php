<?php

declare(strict_types=1);

namespace App\Providers;

use Domain\Auth\Providers\AuthServiceProvider;
use Domain\Catalog\Providers\CatalogServiceProvider;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(CatalogServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
    }
}
