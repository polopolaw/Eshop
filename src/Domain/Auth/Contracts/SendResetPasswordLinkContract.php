<?php

declare(strict_types=1);

namespace Domain\Auth\Contracts;

interface SendResetPasswordLinkContract
{
    public function handle(string $email): string;
}
