<x-layouts.app :title="$course->title . ' checkout'" active="courses">
    <section class="content-page shell">
        <div class="checkout-layout">
            <div><span class="eyebrow">ENROLLMENT</span>
                <h1>Start {{ $course->title }}</h1>
                <p>{{ $course->description }}</p>
                <ul class="feature-list">
                    <li>{{ $course->lesson_count }} lessons</li>
                    <li>{{ $course->level }} level</li>
                    <li>Learn at your own pace</li>
                </ul>
            </div>
            <aside class="content-card checkout-card"><span>One-time
                    access</span><strong>${{ number_format($course->price_cents / 100) }}</strong>
                <form method="POST" action="{{ route('courses.enroll', $course) }}">@csrf<button class="primary-button"
                        type="submit">Enroll now →</button></form><small>Demo checkout. Payment integration can be
                    connected here.</small>
            </aside>
        </div>
    </section>
</x-layouts.app>
