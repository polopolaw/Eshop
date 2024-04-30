<?php

declare(strict_types=1);

namespace Ecom\Core\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->middleware('throttle:global')
            ->group(module_path('Core', '/routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes(): void
    {
        Route::middleware('api')->prefix('api')->name('api.')->group(module_path('Core', '/routes/api.php'));
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('global', function (Request $request) {
            return Limit::perMinute(app()->isProduction() ? 5 : 100)
                ->by($request->user()?->id ?: $request->ip())
                ->response(static function (Request $request, array $headers) {
                    return response(__('Take it easy'), Response::HTTP_TOO_MANY_REQUESTS, $headers);
                });
        });
    }
}
