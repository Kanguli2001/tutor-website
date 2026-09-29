@extends('layouts.auth')

@section('title', 'Choose a new password')

@section('auth-content')
    <h1>Choose a new password</h1>
    <p class="auth-subtitle">Set a new password for your Mawey account.</p>

    @if ($errors->any())
        <div class="auth-alert" role="alert">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="auth-form">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <label>Email Address
            <input class="form-field" type="email" name="email" value="{{ $email }}" autocomplete="email" required>
        </label>
        <label>New Password
            <span class="auth-password-wrap">
                <input class="form-field" id="reset-password" type="password" name="password"
                    autocomplete="new-password" required>
                <button class="auth-password-toggle" type="button" data-password-toggle
                    aria-controls="reset-password" aria-label="Show password" aria-pressed="false">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M2 12s3.6-6 10-6 10 6 10 6-3.6 6-10 6-10-6-10-6Z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </span>
        </label>
        <label>Confirm Password
            <input class="form-field" type="password" name="password_confirmation"
                autocomplete="new-password" required>
        </label>
        <button class="primary-button form-submit" type="submit">Update Password</button>
    </form>
@endsection
