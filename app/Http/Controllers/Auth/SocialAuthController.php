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

    public function githubCallback(): RedirectResponse
    {
        try {
            $githubUser = Socialite::driver('github')->user();
        } catch (Throwable $e) {
            throw new DomainException(__('Something wen wrong'));
        }

        $user = User::query()
            ->where('github_id', $githubUser->id)
            ->firstOr(function () use ($githubUser) {
                return User::query()->updateOrCreate([
                    'email' => $githubUser->email,
                ], [
                    'github_id' => $githubUser->id,
                    'name' => $githubUser->name,
                    'email' => $githubUser->email,
                    'password' => bcrypt(str()->random(10)),
                ]);
            });

        auth()->login($user);

        return redirect()
            ->intended(route('home'));
    }
}
