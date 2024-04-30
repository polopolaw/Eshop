<?php

declare(strict_types=1);

namespace Domain\Auth\Providers;

use Domain\Auth\Actions\RegisterNewUserAction;
use Domain\Auth\Actions\SendResetPasswordLink;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\Contracts\SendResetPasswordLinkContract;
use Illuminate\Support\ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    public array $bindings = [
        RegisterNewUserContract::class => RegisterNewUserAction::class,
        SendResetPasswordLinkContract::class => SendResetPasswordLink::class,
    ];
}
