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

    <!-- HEADER -->
    <header class="site-header">
        <div class="shell header-inner">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-icon">✦</span>
                <span class="brand-home">Mawey Tutorials</span>
            </a>

            <nav class="site-nav">
                <a class="{{ $active === 'courses' ? 'is-active' : '' }}" href="{{ route('courses.index') }}">Courses</a>
                <a class="{{ $active === 'tutorials' ? 'is-active' : '' }}" href="{{ route('tutorials.index') }}">Tutorials</a>
                <a href="{{ route('pricing') }}">Pricing</a>
                <a class="{{ $active === 'about' ? 'is-active' : '' }}" href="{{ route('about') }}">About</a>
                <a href="{{ route('faq') }}">FAQ</a>
            </nav>

            <div class="header-actions">
                @auth
                    <a class="primary-button header-button" href="{{ route('profile') }}">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right:6px;">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="header-logout">
                        @csrf
                        <button class="secondary-button header-button" type="submit">Log out</button>
                    </form>
                @else
                    <a class="primary-button header-button" href="{{ route('sign-up') }}">Get Started</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- ADMIN SIDEBAR -->
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

    <!-- TUTOR SIDEBAR -->
    @if (Auth::check() && Auth::user()->role === 'tutor')
        <aside class="admin-sidebar role-sidebar">
            <a class="admin-sidebar-brand" href="{{ route('tutor.dashboard') }}">
                <span class="brand-icon">✦</span><span>Mawey Tutor</span>
            </a>
            <nav class="admin-sidebar-nav">
                <a href="{{ route('tutor.dashboard') }}" class="{{ request()->routeIs('tutor.dashboard') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    Overview
                </a>
                <a href="{{ route('tutor.courses.create') }}" class="{{ request()->routeIs('tutor.courses.create') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Create course
                </a>
                <a href="{{ route('tutor.analytics') }}" class="{{ request()->routeIs('tutor.analytics') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                    Analytics
                </a>
                <a href="{{ route('courses.index') }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    Course catalog
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

    <!-- STUDENT SIDEBAR -->
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

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="shell footer-grid">

            <!-- Column 1: Brand & Socials -->
            <div class="footer-brand-col">
                <a class="brand" href="{{ route('home') }}">
                    <span class="brand-icon">✦</span><span>Mawey</span>
                </a>
                <p>The ultimate destination for curious minds to master the skills of tomorrow.</p>

                <div class="socials">
                    <a href="#" aria-label="Twitter" title="Twitter">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="#" aria-label="LinkedIn" title="LinkedIn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.063 2.063 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="#" aria-label="YouTube" title="YouTube">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Column 2: Platform -->
            <div class="footer-link-col">
                <b>Platform</b>
                <a href="{{ route('courses.index') }}">Browse Courses</a>
                <a href="{{ route('tutorials.index') }}">Free Tutorials</a>
                <a href="{{ route('pricing') }}">Pricing Plans</a>
                <a href="{{ route('faq') }}">FAQ</a>
            </div>

            <!-- Column 3: Company -->
            <div class="footer-link-col">
                <b>Company</b>
                <a href="{{ route('about') }}">About Us</a>
                <a href="{{ route('tutor.dashboard') }}">Instructor Hub</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>

            <!-- Column 4: Newsletter -->
            <div class="footer-newsletter-col">
                <b>Newsletter</b>
                <p>Get the latest tutorial updates and new course alerts.</p>
                <form method="POST" action="{{ route('newsletter.subscribe') }}" class="footer-email">
                    @csrf
                    <input name="email" type="email" placeholder="Enter your email" required>
                    <button type="submit" aria-label="Subscribe">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </form>
            </div>

        </div>

        <div class="shell footer-bottom">
            <span>© 2026 Mawey Tutorials. All rights reserved.</span>
            <span class="footer-legal-links">
                <a href="{{ route('privacy') }}">Privacy</a>
                <a href="{{ route('terms') }}">Terms</a>
                <a href="{{ route('refund') }}">Refund</a>
            </span>
        </div>
    </footer>

    <script>
    (() => {
        const btn  = document.getElementById('load-more-btn');
        const grid = document.getElementById('tutorial-grid');
        if (!btn || !grid) return;

        btn.addEventListener('click', async () => {
            const url = btn.dataset.nextUrl;
            if (!url) return;

            btn.textContent = 'Loading...';
            btn.disabled = true;

            try {
                const res = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                if (!res.ok) throw new Error('Request failed');

                const html = await res.text();
                grid.insertAdjacentHTML('beforeend', html);

                const nextUrl = res.headers.get('X-Next-Page-Url');
                if (nextUrl && nextUrl !== '') {
                    btn.dataset.nextUrl = nextUrl;
                    btn.textContent = 'Load More Tutorials';
                    btn.disabled = false;
                } else {
                    btn.style.display = 'none';
                }
            } catch (e) {
                btn.textContent = 'Try Again';
                btn.disabled = false;
            }
        });
    })();
    </script>
</body>

</html>