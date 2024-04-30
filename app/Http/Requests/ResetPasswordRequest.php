<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guest();
    }

    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email:dns,rfc',
            'password' => 'required|min:8|confirmed',
        ];
    }
}
