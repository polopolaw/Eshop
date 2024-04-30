<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Domain\Auth\Actions\SendResetPasswordLink;
use Domain\Auth\Contracts\SendResetPasswordLinkContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function page(): View|Application|Factory|RedirectResponse
    {
        return view('auth.forgot-password');
    }

    /**
     * @param  SendResetPasswordLink  $action
     */
    public function handle(ForgotPasswordRequest $request, SendResetPasswordLinkContract $action): RedirectResponse
    {
        $status = $action->handle($request->input('email'));

        if ($status === Password::RESET_LINK_SENT) {
            flash()->info(__($status));

            return back();
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
