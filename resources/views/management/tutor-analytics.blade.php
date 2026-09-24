<x-layouts.app title="Tutor Analytics - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading"><span class="eyebrow">INSTRUCTOR ANALYTICS</span>
            <h1>Understand your course reach.</h1>
        </div>
        <div class="management-grid">
            <article class="content-card">
                <h2>Course performance</h2>
                @forelse($courses as $course)
                    <p class="table-row"><span>{{ $course->title }}</span><small>{{ $course->enrollments_count }}
                        students</small></p>@empty<p>Create a course to see analytics.</p>
                @endforelse
            </article>
            <article class="content-card">
                <h2>Payout history</h2>
                @forelse($payouts as $payout)
                    <p class="table-row">
                        <span>${{ number_format($payout->amount_cents / 100, 2) }}</span><small>{{ ucfirst($payout->status) }}</small>
                </p>@empty<p>No payouts recorded yet.</p>
                @endforelse
            </article>
        </div>
    </section>
</x-layouts.app>
