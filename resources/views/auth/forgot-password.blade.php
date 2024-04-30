@extends('layouts.master')

@section('title', __('Forgot password'))

@section('content')
    <x-forms.auth-forms
        title="{{ __('Forgot password') }}"
        action="{{ route('forgot.handle') }}"
    >

        <x-forms.fields.text-input
            name="email"
            :isError="$errors->has('email')"
            required="true"
            type="email"
            placeholder="{{ __('E-mail') }}"
        />

        @error('email')
        <x-forms.fields.error>
            {{ $message }}
        </x-forms.fields.error>
        @enderror

        <x-forms.fields.primary-button>
            {{ __('Send') }}
        </x-forms.fields.primary-button>

        <x-slot:socialAuth>
            <x-forms.social-auth/>
        </x-slot:socialAuth>

        <x-slot:actions>
            <div class="space-y-3 mt-5">
                <x-forms.register-action/>
                <x-forms.login-action/>
            </div>
        </x-slot:actions>

        <x-slot:docs>
            <x-forms.form-docs-links/>
        </x-slot:docs>
    </x-forms.auth-forms>
@endsection

