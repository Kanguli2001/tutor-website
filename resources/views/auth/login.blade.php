@extends('layouts.auth')

@section('title', 'Log in')

@section('auth-content')
    <h1>Welcome back</h1>
    <p class="auth-subtitle">Continue building skills that move you forward.</p>

    @if (session('status'))
        <div class="auth-alert auth-alert-success" role="status">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <div class="auth-alert" role="alert">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.store') }}" class="auth-form">
        @csrf
        <label>Email Address
            <input class="form-field" type="email" name="email" value="{{ old('email') }}"
                autocomplete="email" required>
        </label>

        <label>Password
            <span class="auth-password-wrap">
                <input class="form-field" id="login-password" type="password" name="password"
                    autocomplete="current-password" required>
                <button class="auth-password-toggle" type="button" data-password-toggle
                    aria-controls="login-password" aria-label="Show password" aria-pressed="false">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M2 12s3.6-6 10-6 10 6 10 6-3.6 6-10 6-10-6-10-6Z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </span>
        </label>

        <div class="auth-form-meta">
            <label class="auth-remember"><input type="checkbox" name="remember"> Remember me</label>
            <a class="text-link" href="{{ route('password.request') }}">Forgot password?</a>
        </div>

        <button class="primary-button form-submit" type="submit">Log In</button>
    </form>

    <p class="auth-switch">New to Mawey? <a class="text-link" href="{{ route('sign-up') }}">Create an account</a></p>
@endsection