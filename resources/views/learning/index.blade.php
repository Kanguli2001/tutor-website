<x-layouts.app title="My Learning - Mawey Tutorials">
    <section class="content-page shell">
        <div class="dashboard-header">
            <div class="page-heading">
                <span class="eyebrow">MY LEARNING</span>
                <h1>Keep making progress.</h1>
                <p>Your enrolled courses, all in one place.</p>
            </div>
            
            @if (session('status'))
                <div class="welcome-banner-alert">
                    <span>👋</span>
                    <p>{{ session('status') }}</p>
                </div>
            @endif
        </div>

        <div class="learning-grid">
            @forelse($enrollments as $enrollment)
                <article class="content-card">
                    <div class="card-image-placeholder"></div>
                    <div class="card-body">
                        <h2>{{ $enrollment->course->title }}</h2>
                        <p>{{ Str::limit($enrollment->course->description, 100) }}</p>
                        <div class="progress-wrapper">
                            <div class="progress-track">
                                <span style="width:{{ $enrollment->progress }}%"></span>
                            </div>
                            <small>{{ $enrollment->progress }}% complete</small>
                        </div>
                        <a class="primary-button" href="{{ route('learning.course', $enrollment->course) }}">Continue learning</a>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#4d42e9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            <path d="M12 7v10"></path>
                            <path d="M8 11h8"></path>
                        </svg>
                    </div>
                    <h2>Your learning library is ready.</h2>
                    <p>Enroll in a course to start tracking your progress and building your skills.</p>
                    <a class="primary-button" href="{{ route('courses.index') }}">Browse Courses</a>
                </div>
            @endforelse
        </div>
    </section>
</x-layouts.app>