<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Reset password - Mawey Tutorials</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>

<body>
    <main class="auth-page">
        <section class="auth-panel"><a class="brand" href="{{ route('home') }}"><span class="brand-icon">✦</span>Mawey</a>
            <h1>Reset your password</h1>
            <p>Enter your email and we will send reset instructions.</p>
            @if (session('status'))
                <div class="form-alert">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="form-alert">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="stack-form">@csrf<label>Email<input
                        class="form-field" type="email" name="email" required></label><button
                    class="primary-button form-submit" type="submit">Send reset link →</button></form><a
                class="text-link" href="{{ route('login') }}">Back to login</a>
        </section>
    </main>
</body>

</html>
