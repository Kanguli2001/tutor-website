<x-layouts.app :title="$course->title . ' - Learning'" active="courses">
    <section class="content-page shell">
        <div class="page-heading"><span class="eyebrow">COURSE PLAYER</span>
            <h1>{{ $course->title }}</h1>
            <p>{{ $course->description }}</p>
        </div>
        @if (session('status'))
            <div class="form-alert">{{ session('status') }}</div>
        @endif
        <div class="lesson-layout">
            <main class="content-card lesson-player">
                <div class="lesson-placeholder">Lesson content area</div>
                <h2>Course lessons</h2>
                <p>Complete each lesson to update your progress and unlock your certificate.</p>
                @foreach ($course->modules as $module)
                    <h3>{{ $module->title }}</h3>
                    @foreach ($module->lessons as $lesson)
                        <article class="lesson-content">
                            <h4>{{ $lesson->title }}</h4>
                            @if ($lesson->content_type === 'video' && $lesson->video_url)
                                <a class="text-link" href="{{ $lesson->video_url }}" target="_blank"
                                rel="noreferrer">Open lesson video</a>@else<p>
                                    {{ $lesson->content ?: 'This lesson is ready to begin.' }}</p>
                            @endif
                        </article>
                        <div class="lesson-row"><span>{{ $lesson->duration_minutes }}m</span>
                            @if ($completedLessons->contains($lesson->id))
                            <span class="status">Complete</span>@else<form method="POST"
                                    action="{{ route('learning.lesson.complete', [$course, $lesson]) }}">@csrf<button
                                        class="secondary-button" type="submit">Mark complete</button></form>
                            @endif
                        </div>
                    @endforeach
                    @endforeach@if ($enrollment->progress === 100)
                        <a class="primary-button" href="{{ route('learning.certificate', $course) }}">View
                            certificate</a>
                    @endif
                    <form method="POST" action="{{ route('courses.reviews.store', $course) }}" class="review-form">
                        @csrf<h3>Leave a review</h3><select name="rating" required>
                            <option value="">Rating</option>
                            @for ($rating = 5; $rating >= 1; $rating--)
                                <option value="{{ $rating }}">{{ $rating }} / 5</option>
                            @endfor
                        </select>
                        <textarea name="body" placeholder="What did you think?" required></textarea><button class="secondary-button" type="submit">Submit review</button>
                    </form>
            </main>
            <aside class="content-card module-list">
                <h2>Progress</h2>
                <div class="progress-track"><span style="width:{{ $enrollment->progress }}%"></span></div>
                <strong>{{ $enrollment->progress }}% complete</strong>
            </aside>
        </div>
    </section>
</x-layouts.app>
