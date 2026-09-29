<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title') - Mawey Tutorials</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>

<body>
    <main class="auth-page auth-layout">
        <section class="auth-art" aria-label="Mawey Tutorials">
            <a class="brand" href="{{ route('home') }}">
                <svg class="auth-brand-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="m2 9 10-5 10 5-10 5L2 9Z" />
                    <path d="M6 11v5c3.5 2.7 8.5 2.7 12 0v-5M22 9v6" />
                </svg>
                Mawey Tutorials
            </a>

            <div class="auth-art-copy">
                <h2>Join the community<br>of modern <span>creators.</span></h2>
                <ul>
                    <li><span class="auth-check" aria-hidden="true">&#10003;</span>Access 50+ deep-dive courses and weekly tutorials.</li>
                    <li><span class="auth-check" aria-hidden="true">&#10003;</span>Downloadable source files and design assets.</li>
                    <li><span class="auth-check" aria-hidden="true">&#10003;</span>Private community for networking and support.</li>
                </ul>
            </div>

            <blockquote class="auth-testimonial">
                “Mawey Tutorials completely changed how I approach UI development. The focus on the ‘why’ makes all the difference.”
            </blockquote>
        </section>

        <section class="auth-main">
            <div class="auth-panel">
                @yield('auth-content')
            </div>
        </section>
    </main>

    <script>
        document.querySelectorAll('[data-password-toggle]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.getAttribute('aria-controls'));
                const isVisible = input.type === 'text';
                input.type = isVisible ? 'password' : 'text';
                button.setAttribute('aria-pressed', String(!isVisible));
                button.setAttribute('aria-label', isVisible ? 'Show password' : 'Hide password');
            });
        });
    </script>
</body>

</html>