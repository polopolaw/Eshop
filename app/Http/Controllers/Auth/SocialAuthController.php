<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Domain\Auth\Models\User;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialAuthController extends Controller
{
    public function github(): \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
    {
        try {
            return Socialite::driver('github')->redirect();
        } catch (Throwable $e) {
            throw new DomainException(__('Error with driver'));
        }
    }

    public function callback(string $driver): RedirectResponse
    {
        try {
            $socialiteUser = Socialite::driver($driver)->user();
        } catch (Throwable $e) {
            throw new DomainException(__('Something went wrong'));
        }

        $user = User::query()
            ->updateOrCreate([
                $driver . '_id' => $socialiteUser->getId()
            ], [
                'name' => $socialiteUser->getName(),
                'email' => $socialiteUser->getEmail(),
                'password' => bcrypt(str()->random(10)),
            ]);

        auth()->login($user);

        return redirect()
            ->intended(route('home'));
    }
}
