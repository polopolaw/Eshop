<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SignUpFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:1'],
            'email' => ['required', 'email:rfc,dns', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function authorize(): bool
    {
        return auth()->guest();
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'email' => str(request('email'))
                ->squish()
                ->lower()
                ->value(),
        ]);
    }
}
