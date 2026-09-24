<x-layouts.app title="Mawey Tutorials - Master any skill">
    <section class="home-hero shell">
        <span class="new-pill">✦ &nbsp; New courses added weekly</span>
        <h1>Master Any Skill with <em>Mawey<br>Tutorials</em></h1>
        <p>Expert-led tutorials designed for the modern learner. Build real skills<br class="desktop-only"> with
            interactive lessons, hands-on projects, and a supportive<br class="desktop-only"> community.</p>
        <div class="home-actions">
            <a class="primary-button" href="{{ route('sign-up') }}">Start Learning Now</a>
            <a class="secondary-button" href="{{ route('courses.index') }}">Browse Courses</a>
        </div>
        <img class="hero-photo" src="{{ asset('images/references/student-image.jpg') }}"
            alt="Student learning at a laptop">
    </section>

    <!-- TRUSTED ROW SECTION -->
    <!-- I added inline styles here as a fallback to guarantee centering and spacing -->
    <section style="text-align: center; padding: 50px 20px;">
        <p style="color: #6b7280; font-size: 14px; margin-bottom: 30px;">Trusted by over 500 students at companies like</p>
        
        <div style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 40px;">
            
            <!-- Using placeholder images so you can see the layout working. 
                 Replace the src with your actual asset() paths once you confirm they work. -->
            <img style="height: 40px; width: auto; object-fit: contain; filter: grayscale(100%); opacity: 0.6;" 
                 src="{{ asset('images/references/company-logo-1.png') }}" alt="Company logo 1">
                 
            <img style="height: 40px; width: auto; object-fit: contain; filter: grayscale(100%); opacity: 0.6;" 
                 src="{{ asset('images/references/company-logo-2.png') }}" alt="Company logo 2">
                 
            <img style="height: 40px; width: auto; object-fit: contain; filter: grayscale(100%); opacity: 0.6;" 
                 src="{{ asset('images/references/company-logo-3.png') }}" alt="Company logo 3">
                 
            <img style="height: 40px; width: auto; object-fit: contain; filter: grayscale(100%); opacity: 0.6;" 
                 src="{{ asset('images/references/company-logo-4.png') }}" alt="Company logo 4">
                 
            <img style="height: 40px; width: auto; object-fit: contain; filter: grayscale(100%); opacity: 0.6;" 
                 src="{{ asset('images/references/company-logo-5.png') }}" alt="Company logo 5">

            <img style="height: 40px; width: auto; object-fit: contain; filter: grayscale(100%); opacity: 0.6;" 
                 src="{{ asset('images/references/company-logo-6.png') }}" alt="Company logo 6">

            <img style="height: 40px; width: auto; object-fit: contain; filter: grayscale(100%); opacity: 0.6;" 
                 src="{{ asset('images/references/company-logo-7.png') }}" alt="Company logo 7">
        
            <img style="height: 40px; width: auto; object-fit: contain; filter: grayscale(100%); opacity: 0.6;" 
                 src="{{ asset('images/references/company-logo-8.png') }}" alt="Company logo 8">

            <img style="height: 40px; width: auto; object-fit: contain; filter: grayscale(100%); opacity: 0.6;" 
                 src="{{ asset('images/references/company-logo-9.png') }}" alt="Company logo 9">

        </div>
    </section>

    <section class="benefits shell">
        <div class="section-title">
            <h2>Why learners choose Mawey Tutorials</h2>
            <p>Everything you need to go from beginner to confident practitioner.</p>
        </div>
        <div class="benefit-grid">
            <article>
                <span class="benefit-icon">▣</span>
                <h3>Expert Instructors</h3>
                <p>Learn directly from industry leaders who bring years of real-world experience into every lesson.</p>
            </article>
            <article>
                <span class="benefit-icon">◷</span>
                <h3>Flexible Learning</h3>
                <p>Study at your own pace, on any device. Pause, rewind, and revisit lessons whenever you need them.</p>
            </article>
            <article>
                <span class="benefit-icon">♟</span>
                <h3>Hands-on Projects</h3>
                <p>Apply what you learn immediately with guided projects that build a portfolio you can be proud of.</p>
            </article>
        </div>
    </section>
</x-layouts.app>