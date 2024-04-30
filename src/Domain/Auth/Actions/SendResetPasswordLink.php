<?php

declare(strict_types=1);

namespace Domain\Auth\Actions;

use Domain\Auth\Contracts\SendResetPasswordLinkContract;
use Illuminate\Support\Facades\Password;

class SendResetPasswordLink implements SendResetPasswordLinkContract
{
    public function handle(string $email): string
    {
        return Password::sendResetLink(
            ['email' => $email]
        );
    }
}
