<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Requests\ResetPasswordRequest;
use Database\Factories\UserFactory;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_it_reset_page_success(): void
    {
        $user = UserFactory::new()->create();
        $broker = app(PasswordBrokerManager::class);

        $token = $broker->broker()->createToken($user);

        $this->get(action([ResetPasswordController::class, 'page'], ['token' => $token]))
            ->assertOk()
            ->assertViewIs('auth.reset-password');
    }

    public function test_it_reset_password_success(): void
    {
        Event::fake();

        $user = UserFactory::new()->create();
        $broker = app(PasswordBrokerManager::class);

        $token = $broker->broker()->createToken($user);
        $password = fake()->password(15);
        $request = ResetPasswordRequest::factory()
            ->create([
                'email' => $user->email,
                'token' => $token,
                'password' => $password,
                'password_confirmation' => $password
            ]);

        $response = $this->post(action([ResetPasswordController::class, 'handle']), $request);

        Event::assertDispatched(PasswordReset::class);

        $this->assertCredentials(['email' => $user->email, 'password' => $password]);
        $response->assertValid()
            ->assertRedirect(route('login'));
    }

}
