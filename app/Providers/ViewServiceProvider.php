<?php

declare(strict_types=1);

namespace App\Providers;

use App\View\Composers\NavigationComposer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Support\ValueObjects\Currency;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', NavigationComposer::class);
        View::composer('catalog.*', static function (\Illuminate\View\View $view) {
            $view->with('currency', Currency::make(Cache::get('current_currency', 'RUB')));
        });

        Vite::macro('image', fn(string $asset) => $this->asset("resources/images/{$asset}"));
    }
}
