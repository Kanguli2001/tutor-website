@props(['title' => 'Mawey Tutorials', 'active' => ''])
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mawey-theme.css') }}">
</head>

<body class="{{ Auth::check() ? 'has-' . Auth::user()->role . '-sidebar' : '' }}">
    <header class="site-header">
        <div class="shell header-inner"><a class="brand" href="{{ route('home') }}"><span
                    class="brand-icon">✦</span><span class="brand-home">Mawey Tutorials</span></a>
            <nav class="site-nav"><a class="{{ $active === 'courses' ? 'is-active' : '' }}"
                    href="{{ route('courses.index') }}">Courses</a><a
                    class="{{ $active === 'tutorials' ? 'is-active' : '' }}"
                    href="{{ route('tutorials.index') }}">Tutorials</a><a href="{{ route('pricing') }}">Pricing</a><a
                    class="{{ $active === 'about' ? 'is-active' : '' }}" href="{{ route('about') }}">About</a><a
                    href="{{ route('faq') }}">FAQ</a></nav>@auth<a class="primary-button header-button"
                    href="{{ route('profile') }}">Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="header-logout">@csrf<button
                    class="secondary-button header-button" type="submit">Log out</button></form>@else<a
                class="primary-button header-button" href="{{ route('sign-up') }}">Get Started</a>@endauth
        </div>
    </header>
        @if (Auth::check() && Auth::user()->role === 'admin')
        <aside class="admin-sidebar">
            <a class="admin-sidebar-brand" href="{{ route('admin.dashboard') }}">
                <span class="brand-icon">✦</span><span>Mawey Admin</span>
            </a>
            <nav class="admin-sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    Overview
                </a>
                <a href="{{ route('admin.analytics') }}" class="{{ request()->routeIs('admin.analytics') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                    Analytics
                </a>
                <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    Users
                </a>
                <a href="{{ route('admin.categories') }}" class="{{ request()->routeIs('admin.categories') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                    Categories
                </a>
                <a href="{{ route('courses.index') }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    Course catalog
                </a>
                <a href="{{ route('contact') }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    Support
                </a>
                <a href="{{ route('profile') }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    My profile
                </a>
            </nav>
            <form method="POST" action="{{ route('logout') }}" class="admin-sidebar-logout">@csrf
                <button type="submit">Log out</button>
            </form>
        </aside>
    @endif
    @if (Auth::check() && Auth::user()->role === 'tutor')
        <aside class="admin-sidebar role-sidebar"><a class="admin-sidebar-brand"
                href="{{ route('tutor.dashboard') }}"><span class="brand-icon">✦</span><span>Mawey Tutor</span></a>
            <nav class="admin-sidebar-nav"><a href="{{ route('tutor.dashboard') }}">Overview</a><a
                    href="{{ route('tutor.courses.create') }}">Create course</a><a
                    href="{{ route('tutor.analytics') }}">Analytics</a><a href="{{ route('courses.index') }}">Course
                    catalog</a><a href="{{ route('profile') }}">My profile</a></nav>
            <form method="POST" action="{{ route('logout') }}" class="admin-sidebar-logout">@csrf<button
                    type="submit">Log out</button></form>
        </aside>
    @endif
        @if (Auth::check() && Auth::user()->role === 'student')
        <aside class="admin-sidebar role-sidebar">
            <a class="admin-sidebar-brand" href="{{ route('dashboard') }}">
                <span class="brand-icon">✦</span><span>Mawey Learning</span>
            </a>
            <nav class="admin-sidebar-nav">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                    My learning
                </a>
                <a href="{{ route('courses.index') }}" class="{{ request()->routeIs('courses.*') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    Browse courses
                </a>
                <a href="{{ route('tutorials.index') }}" class="{{ request()->routeIs('tutorials.*') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                    Tutorials
                </a>
                <a href="{{ route('notifications') }}" class="{{ request()->routeIs('notifications') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    Notifications
                </a>
                <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    My profile
                </a>
            </nav>
            <form method="POST" action="{{ route('logout') }}" class="admin-sidebar-logout">@csrf
                <button type="submit">Log out</button>
            </form>
        </aside>
    @endif
    <main>{{ $slot }}</main>
    <footer class="site-footer">
        <div class="shell footer-grid">
            <div><a class="brand" href="{{ route('home') }}"><span class="brand-icon">✦</span><span>Mawey</span></a>
                <p>The ultimate destination for curious<br>minds to master the skills of tomorrow.</p>
                <div class="socials">♥　◌　◎</div>
            </div>
            <div><b>Platform</b><a href="{{ route('courses.index') }}">Browse Courses</a><a
                    href="{{ route('tutorials.index') }}">Free Tutorials</a><a href="{{ route('pricing') }}">Pricing
                    Plans</a><a href="{{ route('faq') }}">FAQ</a></div>
            <div><b>Company</b><a href="{{ route('about') }}">About Us</a><a
                    href="{{ route('tutor.dashboard') }}">Instructor Hub</a><a
                    href="{{ route('contact') }}">Contact</a></div>
            <div><b>Newsletter</b>
                <p>Get the latest tutorial updates.</p>
                <form method="POST" action="{{ route('newsletter.subscribe') }}" class="footer-email">@csrf<input
                        name="email" type="email" placeholder="Email" required><button type="submit">➤</button>
                </form>
            </div>
        </div>
        <div class="shell footer-bottom"><span>© 2026 Mawey Tutorials. All rights reserved.</span><span><a
                    href="{{ route('privacy') }}">Privacy</a>　<a href="{{ route('terms') }}">Terms</a>　<a
                    href="{{ route('refund') }}">Refund</a></span></div>
    </footer>
</body>

</html>
