@extends('layouts.master')

@section('title', __('Sign up'))

@section('content')
    <x-forms.auth-forms
        title="{{ __('Sign up') }}"
        action="{{ route('register.handle') }}"
    >
        <x-forms.fields.text-input
            name="name"
            :isError="$errors->has('Name')"
            required="true"
            type="text"
            value="{{ old('name') }}"
            placeholder="{{ __('Name') }}"
        />

        <x-forms.fields.text-input
            name="email"
            :isError="$errors->has('email')"
            required="true"
            type="email"
            value="{{ old('email') }}"
            placeholder="{{ __('E-mail') }}"
        />

        @error('email')
        <x-forms.fields.error>
            {{ $message }}
        </x-forms.fields.error>
        @enderror

        <x-forms.fields.text-input
            name="password"
            :isError="$errors->has('password')"
            required="true"
            type="password"
            placeholder="{{ __('Password') }}"
        />

        @error('password')
        <x-forms.fields.error>
            {{ $message }}
        </x-forms.fields.error>
        @enderror

        <x-forms.fields.text-input
            name="password_confirmation"
            :isError="$errors->has('password_confirmation')"
            required="true"
            type="password"
            placeholder="{{ __('Password confirmation') }}"
        />

        @error('password-confirmation')
        <x-forms.fields.error>
            {{ $message }}
        </x-forms.fields.error>
        @enderror

        <x-forms.fields.primary-button>
            {{ __('Sign up') }}
        </x-forms.fields.primary-button>

        <x-slot:socialAuth>
            <x-forms.social-auth/>
        </x-slot:socialAuth>

        <x-slot:actions>
            <div class="space-y-3 mt-5">
                <x-forms.login-action/>
            </div>
        </x-slot:actions>

        <x-slot:docs>
            <x-forms.form-docs-links/>
        </x-slot:docs>
    </x-forms.auth-forms>
@endsection

