<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\Auth\ForgotPasswordController;
use Database\Factories\Auth\UserFactory;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_forgot_page_success(): void
    {
        $this->get(action([ForgotPasswordController::class, 'page']))
            ->assertOk()
            ->assertSee(__('Forgot password'))
            ->assertViewIs('auth.forgot-password');
    }

    public function test_handle_forgot_password_success(): void
    {
        Notification::fake();

        $user = UserFactory::new()->create();

        $this->post(action([ForgotPasswordController::class, 'handle']), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
    }
}
