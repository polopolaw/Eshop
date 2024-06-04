<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Requests\SignInFormRequest;
use Database\Factories\Auth\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_it_login_page_success(): void
    {
        $this->get(action([LoginController::class, 'page']))
            ->assertOk()
            ->assertSee(__('Login'))
            ->assertViewIs('auth.index');
    }

    public function test_it_sign_in_success()
    {
        $password = '12345678890';
        $user = UserFactory::new()->create([
            'password' => Hash::make($password)
        ]);

        $request = SignInFormRequest::factory()
            ->create([
                'email' => $user->email,
                'password' => $password
            ]);

        $response = $this->post(action([LoginController::class, 'handle']), $request);

        $response->assertValid()
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_logout_success(): void
    {
        $user = UserFactory::new()->create();
        $this->actingAs($user)
            ->delete(action([LoginController::class, 'logout']));

        $this->assertGuest();
    }


}
