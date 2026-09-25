<x-layouts.app title="Contact - Mawey Tutorials">
    <section class="content-page shell">
        
        <!-- Page Header -->
        <div class="page-heading">
            <span class="eyebrow">CONTACT</span>
            <h1>How can we help?</h1>
            <p>Send a message and our team will get back to you.</p>
        </div>

        @if (session('status'))
            <div class="form-alert">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="form-alert">{{ $errors->first() }}</div>
        @endif

        <div class="contact-layout">
            
            <!-- LEFT: Info Sidebar -->
            <aside class="contact-sidebar">
                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <div>
                        <h3>Email Us</h3>
                        <p>support@mawey.com</p>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div>
                        <h3>Response Time</h3>
                        <p>We reply within 24 hours.</p>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </div>
                    <div>
                        <h3>Need Quick Help?</h3>
                        <p>Check out our <a href="{{ route('faq') }}">FAQ</a> for instant answers.</p>
                    </div>
                </div>
            </aside>

            <!-- RIGHT: Contact Form -->
            <form method="POST" action="{{ route('contact.store') }}" class="form-card">
                @csrf

                <!-- Section 1: Your Info -->
                <div class="form-section">
                    <div class="form-section-header">
                        <h2>Your Information</h2>
                        <p>So we know who we're talking to.</p>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Full Name <span class="required">*</span></label>
                            <input class="form-field" id="name" name="name" value="{{ old('name') }}" placeholder="Jane Doe" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input class="form-field" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="jane@example.com" required>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Message -->
                <div class="form-section">
                    <div class="form-section-header">
                        <h2>Your Message</h2>
                        <p>Tell us what's on your mind.</p>
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject <span class="required">*</span></label>
                        <input class="form-field" id="subject" name="subject" value="{{ old('subject') }}" placeholder="e.g. Question about a course" required>
                    </div>

                    <div class="form-group" style="margin-top: 20px;">
                        <label for="message">Message <span class="required">*</span></label>
                        <textarea class="form-field" id="message" name="message" rows="6" placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button class="primary-button" type="submit">
                        Send Message
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 8px;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </div>
            </form>

        </div>
    </section>
</x-layouts.app>