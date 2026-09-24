<x-layouts.app title="Admin Console - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading"><span class="eyebrow">ADMIN CONSOLE</span>
            <h1>Keep the learning platform healthy.</h1>
            <p>{{ $courses->count() }} courses, {{ $messages->count() }} support messages, and {{ $reviews->count() }}
                reviews.</p><a class="secondary-button" href="{{ route('admin.users') }}">Manage users</a> <a
                class="secondary-button" href="{{ route('admin.categories') }}">Manage categories</a> <a
                class="secondary-button" href="{{ route('admin.analytics') }}">View analytics</a>
        </div>
        @if (session('status'))
            <div class="form-alert">{{ session('status') }}</div>
        @endif
        <div class="management-grid">
            <article class="content-card">
                <h2>Course catalog</h2>
                @foreach ($courses as $course)
                    <div class="table-row"><span>{{ $course->title }}<small>{{ $course->reviews_count }} reviews ·
                                {{ $course->approval_status }}</small></span>
                        @if ($course->approval_status !== 'approved')
                            <form method="POST" action="{{ route('admin.courses.approve', $course) }}">@csrf
                                @method('PATCH')<button class="secondary-button" type="submit">Approve</button></form>
                        @endif
                    </div>
                @endforeach
            </article>
            <article class="content-card">
                <h2>Recent support</h2>
                @forelse($messages as $message)
                    <div class="table-row"><span>{{ $message->subject }}</span>
                        <form method="POST" action="{{ route('admin.messages.update', $message->id) }}">@csrf
                            @method('PATCH')<select name="status" onchange="this.form.submit()">
                                <option value="new" @selected($message->status === 'new')>New</option>
                                <option value="in_progress" @selected($message->status === 'in_progress')>In progress</option>
                                <option value="resolved" @selected($message->status === 'resolved')>Resolved</option>
                            </select></form>
                </div>@empty<p>No support messages yet.</p>
                @endforelse
            </article>
            <article class="content-card">
                <h2>Review moderation</h2>
                @forelse($reviews as $review)
                    <div class="table-row"><span>{{ $review->course->title }} · {{ $review->rating }}/5</span>
                        <form method="POST" action="{{ route('admin.reviews.delete', $review) }}">@csrf
                            @method('DELETE')<button class="secondary-button" type="submit">Remove</button></form>
                </div>@empty<p>No reviews to moderate.</p>
                @endforelse
            </article>
        </div>
    </section>
</x-layouts.app>
