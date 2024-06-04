<?php

declare(strict_types=1);

namespace Domain\Auth\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialAuthController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class AuthRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::controller(LoginController::class)
                ->group(function () {
                    Route::get('/login', 'page')
                        ->name('login');
                    Route::post('/login', 'handle')
                        ->middleware('throttle:auth')
                        ->name('login.handle');
                    Route::delete('/logout', 'logout')
                        ->name('logout');
                });
            Route::controller(RegisterController::class)
                ->group(function () {
                    Route::get('/sign-up', 'page')
                        ->name('register');
                    Route::post('/sign-up', 'handle')
                        ->middleware('throttle:auth')
                        ->name('register.handle');
                });
            Route::controller(ForgotPasswordController::class)
                ->group(function () {
                    Route::get('/forgot-password', 'page')
                        ->middleware('guest')
                        ->name('forgot');
                    Route::post('/forgot-password', 'handle')
                        ->middleware('guest')
                        ->name('forgot.handle');
                });
            Route::controller(ResetPasswordController::class)
                ->group(function () {
                    Route::get('/reset-password/{token}', 'page')
                        ->middleware('guest')
                        ->name('password.reset');

                    Route::post('/reset-password', 'handle')
                        ->middleware('guest')
                        ->name('reset.handle');
                });
            Route::controller(SocialAuthController::class)
                ->group(function () {
                    Route::get('/oauth/github/redirect', 'github')
                        ->name('oauth.github');

                    Route::get('/oauth/github/callback', 'githubCallback')
                        ->name('oauth.github.callback');
                });
        });
    }
}
