<?php

declare(strict_types=1);

namespace Domain\Auth\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

readonly class NewUserDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public ?string $email = null,
        public ?string $password = null,
    ) {
    }

    public static function fromRequest(Request $request): NewUserDTO
    {
        return static::make($request->get('name'), $request->get('email'), $request->get('password'));
    }
}
