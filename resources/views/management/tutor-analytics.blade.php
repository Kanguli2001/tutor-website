<x-layouts.app title="Tutor Analytics - Mawey Tutorials">
    <section class="content-page shell">
        
        <!-- Page Header -->
        <div class="page-heading">
            <span class="eyebrow">INSTRUCTOR ANALYTICS</span>
            <h1>Understand your course reach.</h1>
            <p>Track your enrollment growth and earnings across all your courses.</p>
        </div>

        <!-- Metric Cards Row -->
        <div class="analytics-metrics-grid">
            <div class="analytics-metric-card">
                <div class="metric-icon metric-icon-courses">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                </div>
                <div class="metric-data">
                    <strong>{{ $courses->count() }}</strong>
                    <span>Total Courses</span>
                </div>
            </div>
            <div class="analytics-metric-card">
                <div class="metric-icon metric-icon-enrollments">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <div class="metric-data">
                    <strong>{{ $courses->sum('enrollments_count') }}</strong>
                    <span>Total Students</span>
                </div>
            </div>
            <div class="analytics-metric-card">
                <div class="metric-icon metric-icon-revenue">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </div>
                <div class="metric-data">
                    <strong>${{ number_format($payouts->where('status', 'paid')->sum('amount_cents') / 100, 2) }}</strong>
                    <span>Total Earned</span>
                </div>
            </div>
            <div class="analytics-metric-card">
                <div class="metric-icon metric-icon-pending">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
                <div class="metric-data">
                    <strong>${{ number_format($payouts->where('status', 'pending')->sum('amount_cents') / 100, 2) }}</strong>
                    <span>Pending Payouts</span>
                </div>
            </div>
        </div>

        <!-- Two Column Grid -->
        <div class="analytics-two-col">
            
            <!-- Course Performance -->
            <section class="content-card analytics-card">
                <div class="analytics-toolbar">
                    <div>
                        <h2>Course Performance</h2>
                        <p>Enrollment count per course.</p>
                    </div>
                </div>

                @if($courses->count())
                    <div class="performance-list">
                        @foreach($courses as $course)
                            @php
                                $max = max(1, $courses->max('enrollments_count'));
                                $percent = ($course->enrollments_count / $max) * 100;
                            @endphp
                            <div class="performance-row">
                                <div class="performance-header">
                                    <span class="performance-title">{{ $course->title }}</span>
                                    <span class="performance-count">{{ $course->enrollments_count }} students</span>
                                </div>
                                <div class="performance-bar">
                                    <div class="performance-bar-fill" style="width: {{ max(2, $percent) }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-card-state">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                        <p>Create a course to see analytics.</p>
                    </div>
                @endif
            </section>

            <!-- Payout History -->
            <section class="content-card analytics-card">
                <div class="analytics-toolbar">
                    <div>
                        <h2>Payout History</h2>
                        <p>Your earnings from the platform.</p>
                    </div>
                </div>

                @if($payouts->count())
                    <div class="payout-list">
                        @foreach($payouts as $payout)
                            <div class="payout-row">
                                <div class="payout-icon">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                </div>
                                <div class="payout-details">
                                    <span class="payout-amount">${{ number_format($payout->amount_cents / 100, 2) }}</span>
                                    <small>{{ $payout->paid_at ? $payout->paid_at->format('M d, Y') : 'Not yet paid' }}</small>
                                </div>
                                <span class="status-badge status-{{ $payout->status }}">
                                    {{ ucfirst($payout->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-card-state">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        <p>No payouts recorded yet.</p>
                    </div>
                @endif
            </section>

        </div>

    </section>
</x-layouts.app>