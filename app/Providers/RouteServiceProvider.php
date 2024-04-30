<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\RouteRegistrar;
use App\Routing\AppRegistrar;
use Domain\Auth\Routing\AuthRegistrar;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\RateLimiter;
use RuntimeException;

class RouteServiceProvider extends ServiceProvider
{
    protected array $registrars = [
        AppRegistrar::class,
        AuthRegistrar::class,
    ];

    public function boot(): void
    {
        $this->routes(function (Registrar $router) {
            $this->mapRoutes($router, $this->registrars);
        });

        $this->configureRateLimiting();
    }

    protected function mapRoutes(Registrar $router, array $registrars): void
    {
        foreach ($registrars as $registrar) {
            if (! class_exists($registrar) || ! is_subclass_of($registrar, RouteRegistrar::class)) {
                throw new RuntimeException(
                    sprintf(
                        'Cannot map routes \'%s\', it is not a valid routes class',
                        $registrar
                    )
                );
            }

            (new $registrar)->map($router);
        }
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('auth', function (Request $request) {
            return Limit::perMinute(20)
                ->by($request->ip());
        });

        RateLimiter::for('global', function (Request $request) {
            return Limit::perMinute(app()->isProduction() ? 5 : 100)
                ->by($request->user()?->id ?: $request->ip())
                ->response(static function (Request $request, array $headers) {
                    return response(__('Take it easy'), Response::HTTP_TOO_MANY_REQUESTS, $headers);
                });
        });
    }
}
