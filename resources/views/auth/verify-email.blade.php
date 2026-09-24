<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Verify email - Mawey</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>

<body>
    <main class="auth-page">
        <section class="auth-art"><a class="brand" href="{{ route('home') }}"><span class="brand-icon"
                    style="color:#fff">✦</span>Mawey</a>
            <h2>One quick step<br>and you are ready<br>to <span style="color:#d6ff72">learn.</span></h2><img
                src="{{ asset('images/references/51200c31-0.jpg') }}" alt="Abstract learning visual">
        </section>
        <section class="auth-panel verify-panel"><a class="brand" href="{{ route('home') }}"><span
                    class="brand-icon">✦</span>Mawey</a>
            <h1>Verify your email</h1>
            <p>We've sent a 6-digit code to<br><b>j***@example.com.</b> Enter it below to confirm your account.</p>
            <div class="code-row"><span>4</span><span>8</span><span>2</span><span>•</span><span>•</span><span>•</span>
            </div>
            <p>Didn't receive the code? <b style="color:var(--purple)">Resend in 0:59</b></p><a class="secondary-button"
                href="{{ route('sign-up') }}">← Use a different email</a>
        </section>
    </main>
</body>

</html>
