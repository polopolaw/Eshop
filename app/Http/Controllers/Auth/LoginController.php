<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInFormRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function page(): View|Application|Factory|RedirectResponse
    {
        return view('auth.index');
    }

    public function handle(SignInFormRequest $request): RedirectResponse
    {
        if (! auth()->attempt($request->validated())) {
            return back()->withErrors([
                'email' => __('The provided credentials do not match our records.'),
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()
            ->intended(route('home'));
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()
            ->intended(route('home'));
    }
}
