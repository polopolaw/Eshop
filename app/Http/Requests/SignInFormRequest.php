<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc,dns'],
            'password' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->guest();
    }
}
