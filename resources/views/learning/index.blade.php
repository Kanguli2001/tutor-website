<x-layouts.app title="My Learning - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading"><span class="eyebrow">MY LEARNING</span>
            <h1>Keep making progress.</h1>
            <p>Your enrolled courses, all in one place.</p>
        </div>
        @if (session('status'))
            <div class="form-alert">{{ session('status') }}</div>
        @endif
        <div class="learning-grid">
            @forelse($enrollments as $enrollment)
                <article class="content-card">
                    <h2>{{ $enrollment->course->title }}</h2>
                    <p>{{ $enrollment->course->description }}</p>
                    <div class="progress-track"><span style="width:{{ $enrollment->progress }}%"></span></div>
                    <small>{{ $enrollment->progress }}% complete</small><a class="primary-button"
                        href="{{ route('learning.course', $enrollment->course) }}">Continue learning</a>
            </article>@empty<div class="content-card">
                    <h2>Your learning library is ready.</h2>
                    <p>Enroll in a course to start tracking your progress.</p><a class="primary-button"
                        href="{{ route('courses.index') }}">Browse courses</a>
                </div>
            @endforelse
        </div>
    </section>
</x-layouts.app>
