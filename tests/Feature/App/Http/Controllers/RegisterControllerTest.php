<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\SignUpFormRequest;
use App\Listeners\GreetingNewUserListener;
use App\Notifications\GreetingNewUserNotification;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_sign_up_page_success(): void
    {
        $this->get(action([RegisterController::class, 'page']))
            ->assertOk()
            ->assertSee(__('Sign up'))
            ->assertViewIs('auth.sign-up');
    }

    public function test_it_register_success(): void
    {
        Notification::fake();
        Event::fake();

        $request = SignUpFormRequest::factory()
            ->create([
                'email' => 'testemail@gmail.com',
                'password' => 'GGGTYUEEKD@231fdf1',
                'password_confirmation' => 'GGGTYUEEKD@231fdf1'
            ]);

        $this->assertDatabaseMissing('users', [
            'email' => $request['email']
        ]);

        $response = $this->post(
            action([RegisterController::class, 'handle']),
            $request
        );

        $response->assertValid();

        $this->assertDatabaseHas('users', [
            'email' => $request['email']
        ]);

        Event::assertDispatched(Registered::class);
        Event::assertListening(Registered::class, GreetingNewUserListener::class);

        $user = User::query()
            ->where('email', $request['email'])
            ->first();

        $event = new Registered($user);
        $listener = new GreetingNewUserListener();
        $listener->handle($event);

        Notification::assertSentTo($user, GreetingNewUserNotification::class);

        $this->assertAuthenticatedAs($user);

        $response->assertRedirect(route('home'));
    }
}
