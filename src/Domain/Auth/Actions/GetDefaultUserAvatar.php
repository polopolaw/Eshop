<?php

declare(strict_types=1);

namespace Domain\Auth\Actions;

use Domain\Auth\Models\User;

final class GetDefaultUserAvatar
{
    public function handle(User $user): string
    {
        return 'https://ui-avatars.com/api/?name=' . $user->name;
    }
}
