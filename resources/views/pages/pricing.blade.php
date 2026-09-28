<x-layouts.app title="Pricing - Mawey Tutorials">
    <section class="content-page shell">
        
        <!-- Page Header -->
        <div class="page-heading pricing-heading">
            <span class="eyebrow">PRICING</span>
            <h1>Choose your learning path.</h1>
            <p>Start with a single course and grow from there. No hidden fees, no surprises.</p>
        </div>

        <!-- Pricing Cards -->
        <div class="pricing-grid">
            
            <!-- Plan 1: Course Access -->
            <article class="pricing-card">
                <div class="pricing-card-header">
                    <h2>Course Access</h2>
                    <p class="pricing-description">Perfect for learners who want to master one specific skill.</p>
                </div>

                <div class="pricing-price">
                    <span class="pricing-currency">$</span>
                    <span class="pricing-amount">49</span>
                    <span class="pricing-period">starting</span>
                </div>

                <ul class="pricing-features">
                    <li>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Lifetime access to one course
                    </li>
                    <li>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        All future course updates
                    </li>
                    <li>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Hands-on projects & exercises
                    </li>
                    <li>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Certificate on completion
                    </li>
                </ul>

                <a class="primary-button pricing-cta" href="{{ route('courses.index') }}">Browse Courses</a>
            </article>

            <!-- Plan 2: Learning Library (Featured) -->
            <article class="pricing-card pricing-card-featured">
                <div class="pricing-badge">Most Popular</div>
                <div class="pricing-card-header">
                    <h2>Learning Library</h2>
                    <p class="pricing-description">A complete membership for learners who want to explore every topic.</p>
                </div>

                <div class="pricing-price">
                    <span class="pricing-currency">$</span>
                    <span class="pricing-amount">19</span>
                    <span class="pricing-period">/ month</span>
                </div>

                <ul class="pricing-features">
                    <li>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Unlimited access to all courses
                    </li>
                    <li>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        New courses added monthly
                    </li>
                    <li>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Community access
                    </li>
                    <li>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Priority support
                    </li>
                    <li>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Cancel anytime
                    </li>
                </ul>

                <a class="primary-button pricing-cta" href="{{ route('contact') }}">Join the Waitlist</a>
                <p class="pricing-note">Launching soon. Reserve your spot.</p>
            </article>

        </div>

        <!-- Trust / FAQ Section -->
        <div class="pricing-faq">
            <h2>Common Questions</h2>
            <div class="pricing-faq-grid">
                <div class="pricing-faq-item">
                    <h3>Can I get a refund?</h3>
                    <p>Yes — we offer a 30-day money-back guarantee on all course purchases. See our <a href="{{ route('refund') }}">refund policy</a> for details.</p>
                </div>
                <div class="pricing-faq-item">
                    <h3>Do I need prior experience?</h3>
                    <p>Not at all. Every course is designed to take you from beginner to confident practitioner at your own pace.</p>
                </div>
                <div class="pricing-faq-item">
                    <h3>How long do I keep access?</h3>
                    <p>Course purchases grant lifetime access. Library subscriptions stay active as long as your plan is active.</p>
                </div>
                <div class="pricing-faq-item">
                    <h3>Can I switch plans later?</h3>
                    <p>Absolutely. You can upgrade to the library at any time, and your existing courses will always be yours.</p>
                </div>
            </div>
        </div>

    </section>
</x-layouts.app>