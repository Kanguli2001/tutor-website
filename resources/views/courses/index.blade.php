<x-layouts.app title="Explore Courses - Mawey Tutorials" active="courses">
    <section class="catalog-intro shell">
        <h1>Explore Courses</h1>
        <p>Discover deep-dive courses curated by industry professionals. Master new<br class="desktop-only"> frameworks,
            design systems, and business strategies.</p>
        <form method="GET" action="{{ route('courses.index') }}" class="catalog-filters">
            <label>⌕ <input name="search" value="{{ $search ?? '' }}" placeholder="Search courses..."></label>
            <select name="category">
                <option value="">Category</option>
                <option value="WEB DEV">Web Dev</option>
                <option value="DESIGN">Design</option>
                <option value="FULL STACK">Full Stack</option>
                <option value="SECURITY">Security</option>
                <option value="MOBILE">Mobile</option>
                <option value="BUSINESS">Business</option>
            </select>
            <select name="level">
                <option value="">Level</option>
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
            </select>
            <select name="rating">
                <option value="">Rating</option>
                <option value="4">4+ stars</option>
                <option value="4.5">4.5+ stars</option>
            </select>
            <button class="filter-active" type="submit">Search</button>
            <a href="{{ route('courses.index') }}">All Categories</a>
        </form>
    </section>
    <section class="catalog-section">
        <div class="shell">
            <div class="catalog-grid">
                @foreach ($courses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>
            {{ $courses->links('vendor.pagination.custom') }}
            <button class="load-button">Load More Courses</button>
        </div>
    </section>
    <section class="instructor-callout">
        <div class="shell">
            <h2>Become an Instructor?</h2>
            <p>Share your expertise with the world and build your own teaching business on Mawey<br
                    class="desktop-only"> Tutorials.</p>
            <a class="white-button" href="{{ route('tutor.dashboard') }}">Start Teaching Today</a>
        </div>
    </section>
</x-layouts.app>
