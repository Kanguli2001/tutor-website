<x-layouts.app title="Notifications - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading"><span class="eyebrow">NOTIFICATIONS</span>
            <h1>Stay up to date.</h1>
        </div>
        <div class="management-grid">
            @forelse($notifications as $notification)
                <article class="content-card">
                    <strong>{{ $notification->data['message'] ?? 'New Mawey update' }}</strong><small>{{ $notification->created_at->diffForHumans() }}</small>
                    @if (!$notification->read_at)
                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}">@csrf
                            @method('PATCH')<button class="secondary-button" type="submit">Mark read</button></form>
                    @endif
                </article>
            @empty<div class="content-card">
                    <p>You have no notifications.</p>
                </div>
            @endforelse
        </div>
    </section>
</x-layouts.app>
