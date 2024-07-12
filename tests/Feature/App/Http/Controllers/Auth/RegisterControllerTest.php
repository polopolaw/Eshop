<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\SignUpFormRequest;
use App\Listeners\GreetingNewUserListener;
use App\Notifications\GreetingNewUserNotification;
use Database\Factories\Auth\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = SignUpFormRequest::factory()
            ->create([
                'email' => 'testemail@gmail.com',
                'password' => 'GGGTYUEEKD@231fdf1',
                'password_confirmation' => 'GGGTYUEEKD@231fdf1'
            ]);
    }

    private function request(): TestResponse
    {
        return $this->post(
            action([RegisterController::class, 'handle']),
            $this->request
        );
    }

    private function findUser(): User
    {
        return User::query()
            ->where('email', $this->request['email'])
            ->first();
    }


    public function test_it_sign_up_page_success(): void
    {
        $this->get(action([RegisterController::class, 'page']))
            ->assertOk()
            ->assertSee(__('Sign up'))
            ->assertViewIs('auth.sign-up');
    }

    public function test_it_validation_success(): void
    {
        $this->request()
            ->assertValid();
    }

    public function test_it_should_fail_validation_on_password_confirm(): void
    {
        $this->request['password'] = '123';
        $this->request['password_confirmation'] = '1234';

        $this->request()
            ->assertInvalid(['password']);
    }

    public function test_it_user_created_success(): void
    {
        $this->assertDatabaseMissing('users', [
            'email' => $this->request['email']
        ]);

        $this->request();

        $this->assertDatabaseHas('users', [
            'email' => $this->request['email']
        ]);
    }

    public function test_it_should_fail_validation_on_unique_email(): void
    {
        UserFactory::new()->create([
            'email' => $this->request['email']
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $this->request['email']
        ]);

        $this->request()
            ->assertInvalid(['email']);
    }

    public function test_it_registered_event_and_listeners_dispatched(): void
    {
        Event::fake();

        $this->request();

        Event::assertDispatched(Registered::class);
        Event::assertListening(
            Registered::class,
            GreetingNewUserListener::class
        );
    }

    public function test_it_notification_sent(): void
    {
        $this->request();

        Notification::assertSentTo(
            $this->findUser(),
            GreetingNewUserNotification::class
        );
    }

    public function test_it_user_authenticated_after_and_redirected(): void
    {
        $this->request()
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($this->findUser());
    }
}
