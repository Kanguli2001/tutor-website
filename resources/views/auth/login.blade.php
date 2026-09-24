<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Log in - Mawey Tutorials</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>

<body>
    <main class="auth-page">
        <section class="auth-panel">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-icon">✦</span>Mawey
            </a>
            
            <h1>Welcome back</h1>
            <p>Continue building skills that move you forward.</p>
            
            @if ($errors->any())
                <div class="form-alert">{{ $errors->first() }}</div>
            @endif
            
            <form method="POST" action="{{ route('login.store') }}" class="stack-form">
                @csrf
                
                <label>Email
                    <input class="form-field" type="email" name="email" value="{{ old('email') }}" required>
                </label>
                
                <label>Password
                    <input class="form-field" type="password" name="password" required>
                </label>
                
                <label class="check-row">
                    <input type="checkbox" name="remember"> Remember me
                </label>
                
                <button class="primary-button form-submit" type="submit">Log in →</button>
            </form>
            
            <a class="text-link" href="{{ route('password.request') }}">Forgot your password?</a>
            <small>New to Mawey? <a class="text-link" href="{{ route('sign-up') }}">Create an account</a></small>
        </section>
    </main>
</body>

</html>