<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Student Dashboard - Mawey</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>

<body>
    <div class="dashboard-layout">
        <aside class="dash-sidebar"><a class="brand" href="{{ route('home') }}"><span
                    class="brand-icon">✦</span>Mawey</a>
            <nav class="dash-links"><a class="active" href="#">⌂　Overview</a><a
                    href="{{ route('courses.index') }}">▥　All Courses</a><a
                    href="{{ route('tutorials.index') }}">◴　Tutorials</a><a href="#">♟　My Learning</a><a
                    href="#">♙　Certificates</a><a href="{{ route('home') }}">⇥　Sign Out</a></nav>
        </aside>
        <main class="dash-main">
            <div class="dash-topbar">
                <div class="dash-search">Search for courses, lessons, topics...</div>
                <div class="dash-user">♟<span><b>Jane Cooper</b><small>STUDENT</small></span><img class="avatar"
                        src="{{ asset('images/references/0afb40fa-0.jpg') }}" alt="Jane Cooper"></div>
            </div>
            <section class="welcome-banner">
                <div class="welcome-copy">
                    <h1>Welcome back, Jane! ✨</h1>
                    <p>You've completed <b>65%</b> of your weekly goal. Keep it up!</p>
                    <div class="mini-stats">
                        <div><b>12</b><span>COURSES</span></div>
                        <div><b>48h</b><span>STUDY TIME</span></div>
                        <div><b>4</b><span>CERTIFICATES</span></div>
                    </div>
                </div><img src="{{ asset('images/references/0afb40fa-1.jpg') }}" alt="Network illustration">
            </section>
            <div class="student-content">
                <div>
                    <div class="continue-header">
                        <h2>Continue Learning</h2><a href="#">View All</a>
                    </div>
                    <div class="continue-cards">
                        <article class="continue-card"><b>⚛　Advanced React Hooks</b><small>Lesson 8 of 24 · 15m
                                remaining</small>
                            <div class="dash-progress"><i></i></div>
                            <p>Progress　　　　　　　　　　　　 72%</p>
                        </article>
                        <article class="continue-card"><b>✣　Figma Design Systems</b><small>Lesson 3 of 18 · 45m
                                remaining</small>
                            <div class="dash-progress"><i style="width:18%"></i></div>
                            <p>Progress　　　　　　　　　　　　 18%</p>
                        </article>
                    </div>
                    <section class="recommend">
                        <h2>Recommended for You</h2>
                        <div class="recommend-grid">
                            <article class="recommend-card"><img src="{{ asset('images/references/0afb40fa-2.jpg') }}"
                                    alt="Data dashboard"><b>Mastering Data Visualization</b>
                                <p>◷ 8h 20m　★ 4.9</p>
                            </article>
                            <article class="recommend-card"><img src="{{ asset('images/references/0afb40fa-3.jpg') }}"
                                    alt="Code screen"><b>Full-Stack Auth with Next.js</b>
                                <p>◷ 12h 45m　★ 4.8</p>
                            </article>
                        </div>
                    </section>
                </div>
                <aside>
                    <section class="activity-card">
                        <h3>Learning Activity</h3>
                        <div class="activity-chart"></div>
                    </section>
                    <section class="deadlines-card">
                        <h3>Upcoming Deadlines</h3>
                        <div><b>24<br>OCT</b> React Quiz: Context API<br><small>Due at 11:59 PM</small></div>
                        <div><b style="color:#5f5bea">26<br>OCT</b> Final Project Submission<br><small>Due at 5:00
                                PM</small></div>
                    </section>
                </aside>
            </div>
        </main>
    </div>
</body>

</html>
