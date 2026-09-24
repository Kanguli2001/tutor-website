<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Create account - Mawey Tutorials</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>

<body>
    <main class="auth-page">
        <section class="auth-panel"><a class="brand" href="{{ route('home') }}"><span class="brand-icon">✦</span>Mawey</a>
            <h1>Create your account</h1>
            <p>Start learning with a free account.</p>
            @if ($errors->any())
                <div class="form-alert">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('sign-up.store') }}" class="stack-form">@csrf<label>Name<input
                        class="form-field" name="name" value="{{ old('name') }}"
                        required></label><label>Email<input class="form-field" type="email" name="email"
                        value="{{ old('email') }}" required></label><label>Password<input class="form-field"
                        type="password" name="password" required></label><label>Confirm password<input
                        class="form-field" type="password" name="password_confirmation" required></label><button
                    class="primary-button form-submit" type="submit">Create account →</button></form><small>Already
                have an account? <a class="text-link" href="{{ route('login') }}">Log in</a></small>
        </section>
    </main>
</body>

</html>
