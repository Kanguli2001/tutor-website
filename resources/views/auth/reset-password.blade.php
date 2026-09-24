<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Choose a new password - Mawey Tutorials</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>

<body>
    <main class="auth-page">
        <section class="auth-panel"><a class="brand" href="{{ route('home') }}"><span class="brand-icon">✦</span>Mawey</a>
            <h1>Choose a new password</h1>
            <p>Set a new password for your Mawey account.</p>
            @if ($errors->any())
                <div class="form-alert">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('password.update') }}" class="stack-form">@csrf<input type="hidden"
                    name="token" value="{{ $token }}"><label>Email<input class="form-field" type="email"
                        name="email" value="{{ $email }}" required></label><label>New password<input
                        class="form-field" type="password" name="password" required></label><label>Confirm
                    password<input class="form-field" type="password" name="password_confirmation"
                        required></label><button class="primary-button form-submit" type="submit">Update password
                    →</button></form>
        </section>
    </main>
</body>

</html>
