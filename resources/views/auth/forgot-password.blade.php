@extends('layouts.auth')

@section('title', 'Reset your password')

@section('auth-content')
    <h1>Reset your password</h1>
    <p class="auth-subtitle">Enter your email and we will send reset instructions.</p>

    @if (session('status'))
        <div class="auth-alert auth-alert-success" role="status">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <div class="auth-alert" role="alert">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf
        <label>Email Address
            <input class="form-field" type="email" name="email" value="{{ old('email') }}"
                autocomplete="email" required>
        </label>
        <button class="primary-button form-submit" type="submit">Send Reset Link</button>
    </form>

    <p class="auth-switch"><a class="text-link" href="{{ route('login') }}">Back to log in</a></p>
@endsection
