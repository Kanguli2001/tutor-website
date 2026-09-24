<x-layouts.app title="Contact - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading"><span class="eyebrow">CONTACT</span>
            <h1>How can we help?</h1>
            <p>Send a message and our team will get back to you.</p>
        </div>
        @if (session('status'))
            <div class="form-alert">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="form-alert">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('contact.store') }}" class="content-card stack-form contact-form">
            @csrf<label>Name<input class="form-field" name="name" value="{{ old('name') }}"
                    required></label><label>Email<input class="form-field" type="email" name="email"
                    value="{{ old('email') }}" required></label><label>Subject<input class="form-field" name="subject"
                    value="{{ old('subject') }}" required></label><label>Message
                <textarea class="form-field" name="message" rows="6" required>{{ old('message') }}</textarea>
            </label><button class="primary-button" type="submit">Send message →</button></form>
    </section>
</x-layouts.app>
