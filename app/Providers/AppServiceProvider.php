<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\CarbonInterval;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Support\Testing\FakerImageProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Password::defaults(function () {
            return Password::min(8)
                ->mixedCase()
                ->uncompromised();
        });

        Vite::macro('image', fn(string $asset) => $this->asset("resources/images/{$asset}"));

        $this->registerDevelopmentHelpers();
        $this->registerFakerProvider();
    }

    private function registerDevelopmentHelpers(): void
    {
        Model::shouldBeStrict(!app()->isProduction());

        if (app()->isProduction()) {
            DB::listen(static function ($query) {
                if ($query->time > CarbonInterval::milliseconds(500)->milliseconds) {
                    logger()
                        ->channel('telegram')
                        ->debug('whenQueryingForLongerThan: ' . $query->sql);
                }
            });
            $kernel = app(Kernel::class);
            $kernel->whenRequestLifecycleIsLongerThan(
                CarbonInterval::seconds(4),
                static function () {
                    logger()
                        ->channel('telegram')
                        ->debug('whenRequestLifecycleIsLongerThan: ' . request()->url());
                }
            );
        }
    }

    public function registerFakerProvider(): void
    {
        $this->app->singleton(Generator::class, static function () {
            $faker = Factory::create();
            $faker->addProvider(new FakerImageProvider($faker));

            return $faker;
        });
    }
}
