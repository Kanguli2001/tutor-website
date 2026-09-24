<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>System Console - Mawey</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>

<body>
    <main class="admin-page">
        <div class="admin-shell">
            <div class="dashboard-head">
                <div>
                    <p>SYSTEM CONSOLE</p>
                    <h1>Manage global platform state and user identities</h1>
                </div><span class="status">● System Healthy</span>
            </div>
            <div class="metric-grid">
                <article class="metric"><strong>52,482</strong>
                    <p>Total Platform Users　<span style="color:#25a65a">+14%</span></p>
                </article>
                <article class="metric"><strong>$84,200</strong>
                    <p>Platform MRR　<span style="color:#25a65a">+5.2%</span></p>
                </article>
                <article class="metric"><strong>14</strong>
                    <p>Course approvals pending action</p>
                </article>
                <article class="metric"><strong>99.98%</strong>
                    <p>System uptime</p>
                </article>
            </div>
            <section class="wide-panel">
                <h2>Recent Course Approvals</h2>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Instructor</th>
                            <th>Submitted</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Modern UX Research</td>
                            <td>Jane Cooper</td>
                            <td>Today, 09:30</td>
                            <td><span class="status">Approved</span></td>
                        </tr>
                        <tr>
                            <td>Python Automation</td>
                            <td>Robert Fox</td>
                            <td>Yesterday</td>
                            <td><span style="color:#e2a520">Pending review</span></td>
                        </tr>
                        <tr>
                            <td>Designing for Accessibility</td>
                            <td>Leslie Alexander</td>
                            <td>Sep 19</td>
                            <td><span class="status">Approved</span></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
</body>

</html>
