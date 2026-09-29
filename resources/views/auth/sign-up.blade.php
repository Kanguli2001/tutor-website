@extends('layouts.auth')

@section('title', 'Create your account')

@section('auth-content')
    <h1>Create your account</h1>
    <p class="auth-subtitle">Start your 7-day free trial today. No credit card required.</p>

    @if ($errors->any())
        <div class="auth-alert" role="alert">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('sign-up.store') }}" class="auth-form">
        @csrf
        <div class="auth-form-row">
            <label>First Name
                <input class="form-field" type="text" name="first_name" value="{{ old('first_name') }}"
                    autocomplete="given-name" required>
            </label>
            <label>Last Name
                <input class="form-field" type="text" name="last_name" value="{{ old('last_name') }}"
                    autocomplete="family-name" required>
            </label>
        </div>

        <label>Email Address
            <input class="form-field" type="email" name="email" value="{{ old('email') }}"
                autocomplete="email" required>
        </label>

        <label>Password
            <span class="auth-password-wrap">
                <input class="form-field" id="register-password" type="password" name="password"
                    autocomplete="new-password" minlength="8" required>
                <button class="auth-password-toggle" type="button" data-password-toggle
                    aria-controls="register-password" aria-label="Show password" aria-pressed="false">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M2 12s3.6-6 10-6 10 6 10 6-3.6 6-10 6-10-6-10-6Z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </span>
            <span class="auth-hint">Must be at least 8 characters long.</span>
        </label>

        <button class="primary-button form-submit" type="submit">Create Account</button>
    </form>

    <p class="auth-switch">Already have an account? <a class="text-link" href="{{ route('login') }}">Log in</a></p>
    <p class="auth-legal">By signing up, you agree to Mawey's <a href="{{ route('terms') }}">Terms of Service</a> and
        <a href="{{ route('privacy') }}">Privacy Policy</a>.
    </p>
@endsection
