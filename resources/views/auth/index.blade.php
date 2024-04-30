@extends('layouts.master')

@section('title', __('Login'))
@section('content')
    <x-forms.auth-forms
        title="{{ __('Login') }}"
        action="{{ route('login.handle') }}"
        method="POST"
    >

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

        <x-forms.fields.primary-button>
            {{ __('Sign in') }}
        </x-forms.fields.primary-button>

        <x-slot:socialAuth>
            <x-forms.social-auth/>
        </x-slot:socialAuth>

        <x-slot:actions>
            <div class="space-y-3 mt-5">
                <x-forms.lost-password-action/>
                <x-forms.register-action/>
            </div>
        </x-slot:actions>

        <x-slot:docs>
            <x-forms.form-docs-links/>
        </x-slot:docs>
    </x-forms.auth-forms>
@endsection

