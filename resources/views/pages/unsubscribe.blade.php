<x-layouts.app title="Unsubscribe - Mawey Tutorials">
    <section class="content-page shell">
        <div class="content-card">
            <h1>Unsubscribe from updates</h1>
            <p>Stop receiving Mawey newsletter emails.</p>
            @if (session('status'))
                <div class="form-alert">{{ session('status') }}</div>
            @endif
            <form method="POST" action="{{ route('newsletter.unsubscribe.confirm') }}" class="stack-form">@csrf<input
                    class="form-field" type="email" name="email" value="{{ $email }}" required><button
                    class="secondary-button" type="submit">Unsubscribe</button></form>
        </div>
    </section>
</x-layouts.app>
