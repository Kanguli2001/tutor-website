<x-layouts.app title="Pricing - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading"><span class="eyebrow">PRICING</span>
            <h1>Choose your learning path.</h1>
            <p>Start with a single course and grow from there.</p>
        </div>
        <div class="pricing-grid">
            <article class="content-card">
                <h2>Course access</h2><strong>From $49</strong>
                <p>Lifetime access to one course, including updates and projects.</p><a class="primary-button"
                    href="{{ route('courses.index') }}">Browse courses</a>
            </article>
            <article class="content-card featured-card">
                <h2>Learning library</h2><strong>Coming soon</strong>
                <p>A complete membership for learners who want to explore every topic.</p><a class="secondary-button"
                    href="{{ route('contact') }}">Join the waitlist</a>
            </article>
        </div>
    </section>
</x-layouts.app>
