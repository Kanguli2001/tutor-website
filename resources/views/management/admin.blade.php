<x-layouts.app title="Admin Console - Mawey Tutorials">
    <section class="content-page shell">
        <!-- Improved Header Area -->
        <div class="dashboard-header admin-dashboard-header">
            <div class="page-heading">
                <span class="eyebrow">ADMIN CONSOLE</span>
                <h1>Keep the learning platform healthy.</h1>
                <p>Manage your courses, users, and platform activity.</p>
            </div>
            <div class="admin-quick-actions">
                <a class="secondary-button" href="{{ route('admin.users') }}">Manage users</a>
                <a class="secondary-button" href="{{ route('admin.categories') }}">Manage categories</a>
                <a class="secondary-button" href="{{ route('admin.analytics') }}">View analytics</a>
            </div>
        </div>

        <!-- New Stats Row -->
        <div class="admin-stats-row">
            <div class="admin-stat-card">
                <strong>{{ $courses->count() }}</strong>
                <span>Total Courses</span>
            </div>
            <div class="admin-stat-card">
                <strong>{{ $messages->count() }}</strong>
                <span>Support Messages</span>
            </div>
            <div class="admin-stat-card">
                <strong>{{ $reviews->count() }}</strong>
                <span>Reviews</span>
            </div>
        </div>

        @if (session('status'))
            <div class="form-alert">{{ session('status') }}</div>
        @endif

        <!-- Improved Management Grid -->
        <div class="management-grid">
            <article class="content-card admin-card">
                <div class="card-header-flex">
                    <h2>Course catalog</h2>
                    <span class="badge">{{ $courses->count() }} items</span>
                </div>
                <div class="card-scroll-area">
                    @foreach ($courses as $course)
                        <div class="table-row admin-table-row">
                            <div class="row-info">
                                <span class="row-title">{{ $course->title }}</span>
                                <small>{{ $course->reviews_count }} reviews · <span class="status-badge status-{{ $course->approval_status }}">{{ $course->approval_status }}</span></small>
                            </div>
                            @if ($course->approval_status !== 'approved')
                                <form method="POST" action="{{ route('admin.courses.approve', $course) }}">@csrf
                                    @method('PATCH')
                                    <button class="secondary-button small-btn" type="submit">Approve</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </article>

            <article class="content-card admin-card">
                <div class="card-header-flex">
                    <h2>Recent support</h2>
                </div>
                <div class="card-scroll-area">
                    @forelse($messages as $message)
                        <div class="table-row admin-table-row">
                            <div class="row-info">
                                <span class="row-title">{{ $message->subject }}</span>
                            </div>
                            <form method="POST" action="{{ route('admin.messages.update', $message->id) }}">@csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="status-select">
                                    <option value="new" @selected($message->status === 'new')>New</option>
                                    <option value="in_progress" @selected($message->status === 'in_progress')>In progress</option>
                                    <option value="resolved" @selected($message->status === 'resolved')>Resolved</option>
                                </select>
                            </form>
                        </div>
                    @empty
                        <div class="empty-card-state">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                            <p>No support messages yet.</p>
                        </div>
                    @endforelse
                </div>
            </article>

            <article class="content-card admin-card">
                <div class="card-header-flex">
                    <h2>Review moderation</h2>
                </div>
                <div class="card-scroll-area">
                    @forelse($reviews as $review)
                        <div class="table-row admin-table-row">
                            <div class="row-info">
                                <span class="row-title">{{ $review->course->title }}</span>
                                <small>Rating: {{ $review->rating }}/5</small>
                            </div>
                            <form method="POST" action="{{ route('admin.reviews.delete', $review) }}">@csrf
                                @method('DELETE')
                                <button class="secondary-button small-btn danger-btn" type="submit">Remove</button>
                            </form>
                        </div>
                    @empty
                        <div class="empty-card-state">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            <p>No reviews to moderate.</p>
                        </div>
                    @endforelse
                </div>
            </article>
        </div>
    </section>
</x-layouts.app>