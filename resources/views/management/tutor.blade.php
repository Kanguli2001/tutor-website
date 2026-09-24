<x-layouts.app title="Instructor Hub - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading"><span class="eyebrow">INSTRUCTOR HUB</span>
            <h1>Manage your teaching catalog.</h1>
            <p>Review course reach and prepare your next lesson.</p><a class="primary-button"
                href="{{ route('tutor.courses.create') }}">Create course</a> <a class="secondary-button"
                href="{{ route('tutor.analytics') }}">View analytics</a>
        </div>
        @if (session('status'))
            <div class="form-alert">{{ session('status') }}</div>
        @endif
        <div class="management-grid">
            @forelse($courses as $course)
                <article class="content-card">
                    <h2>{{ $course->title }}</h2>
                    <p>{{ $course->enrollments_count }} learners enrolled</p><span
                        class="status">{{ ucfirst($course->status) }}</span>
                    <form method="POST" action="{{ route('tutor.courses.update', $course) }}" class="stack-form">@csrf
                        @method('PUT')<input class="form-field" name="title" value="{{ $course->title }}" required>
                        <textarea class="form-field" name="description" required>{{ $course->description }}</textarea><select class="form-field" name="status">
                            <option value="draft" @selected($course->status === 'draft')>Draft</option>
                            <option value="pending" @selected($course->status === 'pending')>Submit for review</option>
                            <option value="published" @selected($course->status === 'published')>Published</option>
                        </select><button class="secondary-button" type="submit">Save course</button>
                    </form>
                    <form method="POST" action="{{ route('tutor.modules.store', $course) }}" class="stack-form">
                        @csrf<input class="form-field" name="title" placeholder="New module title" required><button
                            class="secondary-button" type="submit">Add module</button></form>
                    @foreach ($course->modules as $module)
                        <div class="table-row">
                            <strong>{{ $module->title }}</strong><small>{{ $module->lessons->count() }}
                                lessons</small></div>
                        @foreach ($module->lessons as $lesson)
                            <div class="table-row"><span>{{ $lesson->title }}</span>
                                <form method="POST" action="{{ route('tutor.lessons.delete', $lesson) }}">@csrf
                                    @method('DELETE')<button class="secondary-button" type="submit">Delete</button>
                                </form>
                            </div>
                        @endforeach
                        <form method="POST" action="{{ route('tutor.lessons.store', $course) }}" class="stack-form">
                            @csrf<input type="hidden" name="module_id" value="{{ $module->id }}"><input
                                class="form-field" name="title" placeholder="Lesson title" required><select
                                class="form-field" name="content_type">
                                <option value="text">Text lesson</option>
                                <option value="video">Video lesson</option>
                            </select>
                            <textarea class="form-field" name="content" placeholder="Lesson content"></textarea><input class="form-field" name="video_url" type="url"
                                placeholder="Video URL (optional)"><input class="form-field" name="duration_minutes"
                                type="number" min="1" placeholder="Minutes" required><button
                                class="secondary-button" type="submit">Add lesson</button>
                        </form>
                    @endforeach
                </article>
            @empty<div class="content-card">
                    <h2>No courses yet</h2>
                    <p>Your instructor workspace is ready for its first course.</p>
                </div>
            @endforelse
        </div>
    </section>
</x-layouts.app>
