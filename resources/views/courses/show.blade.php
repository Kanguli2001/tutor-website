<x-layouts.app :title="$course['title'] . ' - Mawey Tutorials'" active="courses">
    <section class="tutorial-page shell">
        <div class="tutorial-feature">
            <div class="tutorial-feature-image">
                <img src="{{ asset('images/references/' . $course['image']) }}" alt="{{ $course['title'] }}">
                <span class="play-button">▶</span>
                <span class="featured-tag">Featured Course</span>
            </div>
            <div class="tutorial-feature-copy">
                <span class="eyebrow">{{ $course['category'] }}</span>
                <h1>{{ $course['title'] }}</h1>
                <p>{{ $course['description'] }}</p>
                <div class="author-row">
                    <img src="{{ asset('images/references/1d22d654-0.jpg') }}" alt="Instructor">
                    <span>
                        <b>Alex Thompson</b>
                        <small>Senior Web Architect</small>
                    </span>
                </div>
                <a class="watch-button" href="{{ route('dashboard') }}">Start Course　→</a>
            </div>
        </div>
        <section class="content-card course-reviews">
            <h2>Student reviews</h2>
            @forelse($reviews as $review)
                <article class="table-row"><span><strong>{{ $review->user->name }}</strong> ·
                        {{ $review->rating }}/5<br>{{ $review->body }}</span><small>{{ $review->created_at->format('M j, Y') }}</small>
                </article>
            @empty
                <p>No reviews yet. Enroll and be the first to share your experience.</p>
            @endforelse
        </section>
    </section>
</x-layouts.app>
