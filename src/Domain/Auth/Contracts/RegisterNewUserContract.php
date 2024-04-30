<?php

declare(strict_types=1);

namespace Domain\Auth\Contracts;

interface RegisterNewUserContract
{
    public function handle(array $data);
}
