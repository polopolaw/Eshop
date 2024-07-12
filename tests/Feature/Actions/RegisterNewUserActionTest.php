<?php

declare(strict_types=1);

namespace Tests\Feature\Actions;

use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterNewUserActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_success_user_created()
    {
        $this->assertDatabaseMissing('users', [
            'email' => 'test@test.ru'
        ]);

        $action = app(RegisterNewUserContract::class);

        $action->handle(
            NewUserDTO::make(
                'test',
                'test@test.ru',
                '1234567890'
            )
        );

        $this->assertDatabaseHas('users', [
            'email' => 'test@test.ru'
        ]);
    }
}
