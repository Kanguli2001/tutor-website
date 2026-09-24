<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Create your account - Mawey</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>

<body>
    <main class="auth-page">
        <section class="auth-art"><a class="brand" href="{{ route('home') }}"><span class="brand-icon"
                    style="color:#fff">✦</span>Mawey</a>
            <h2>Learn the skills<br>that move you<br><span style="color:#d6ff72">forward.</span></h2><img
                src="{{ asset('images/references/51200c31-0.jpg') }}" alt="Abstract learning visual">
        </section>
        <section class="auth-panel"><a class="brand" href="{{ route('home') }}"><span
                    class="brand-icon">✦</span>Mawey</a>
            <h1>Create your account</h1>
            <p>Start your 7-day free trial today. No credit card required.</p>
            <div class="auth-socials"><button>G　Continue with Google</button><button>◉　Continue with Github</button>
            </div>
            <div class="form-row"><input class="form-field" placeholder="First Name"><input class="form-field"
                    placeholder="Last Name"></div><input class="form-field" placeholder="Email Address"><input
                class="form-field" type="password" placeholder="Password"><a class="primary-button form-submit"
                href="{{ route('verify-email') }}">Create account　→</a><small>Already have an account? <b
                    style="color:var(--purple)">Log in</b></small>
        </section>
    </main>
</body>

</html>
