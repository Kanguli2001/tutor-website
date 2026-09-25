<x-layouts.app title="Instructor Hub - Mawey Tutorials">
    <section class="content-page shell">
        
        <!-- Header with Actions -->
        <div class="dashboard-header admin-dashboard-header">
            <div class="page-heading">
                <span class="eyebrow">INSTRUCTOR HUB</span>
                <h1>Manage your teaching catalog.</h1>
                <p>Review course reach and prepare your next lesson.</p>
            </div>
            <div class="admin-quick-actions">
                <a class="primary-button" href="{{ route('tutor.courses.create') }}">+ Create course</a>
                <a class="secondary-button" href="{{ route('tutor.analytics') }}">View analytics</a>
            </div>
        </div>

        @if (session('status'))
            <div class="form-alert">{{ session('status') }}</div>
        @endif

        <!-- Course List -->
        <div class="tutor-course-list">
            @forelse($courses as $course)
                <article class="tutor-course-card">
                    
                    <!-- Course Header (Always Visible) -->
                    <div class="tutor-course-header">
                        <div class="tutor-course-thumb"></div>
                        <div class="tutor-course-info">
                            <h2>{{ $course->title }}</h2>
                            <div class="tutor-course-meta">
                                <span class="status-badge status-{{ $course->status }}">{{ ucfirst($course->status) }}</span>
                                <span>{{ $course->enrollments_count }} learners enrolled</span>
                                <span>{{ $course->modules->count() }} modules</span>
                            </div>
                        </div>
                    </div>

                    <!-- Collapsible: Edit Course Details -->
                    <details class="tutor-details-section">
                        <summary>Edit course details</summary>
                        <div class="tutor-details-content">
                            <form method="POST" action="{{ route('tutor.courses.update', $course) }}" class="stack-form">
                                @csrf
                                @method('PUT')
                                <label>Title
                                    <input class="form-field" name="title" value="{{ $course->title }}" required>
                                </label>
                                <label>Description
                                    <textarea class="form-field" name="description" rows="3" required>{{ $course->description }}</textarea>
                                </label>
                                <label>Status
                                    <select class="form-field" name="status">
                                        <option value="draft" @selected($course->status === 'draft')>Draft</option>
                                        <option value="pending" @selected($course->status === 'pending')>Submit for review</option>
                                        <option value="published" @selected($course->status === 'published')>Published</option>
                                    </select>
                                </label>
                                <button class="primary-button" type="submit">Save course</button>
                            </form>
                        </div>
                    </details>

                    <!-- Collapsible: Curriculum -->
                    <details class="tutor-details-section" open>
                        <summary>Curriculum ({{ $course->modules->count() }} modules)</summary>
                        <div class="tutor-details-content">
                            
                            @foreach ($course->modules as $module)
                                <div class="module-block">
                                    <div class="module-header">
                                        <span class="module-icon">▸</span>
                                        <div>
                                            <strong>{{ $module->title }}</strong>
                                            <small>{{ $module->lessons->count() }} lessons</small>
                                        </div>
                                    </div>

                                    <!-- Lesson List -->
                                    @if($module->lessons->count())
                                        <div class="lesson-list">
                                            @foreach ($module->lessons as $lesson)
                                                <div class="lesson-item">
                                                    <span class="lesson-title">{{ $lesson->title }}</span>
                                                    <form method="POST" action="{{ route('tutor.lessons.delete', $lesson) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="icon-btn" type="submit" title="Delete lesson">×</button>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="empty-text">No lessons in this module yet.</p>
                                    @endif

                                    <!-- Collapsible: Add Lesson -->
                                    <details class="add-item-details">
                                        <summary>+ Add lesson to this module</summary>
                                        <form method="POST" action="{{ route('tutor.lessons.store', $course) }}" class="stack-form compact-form">
                                            @csrf
                                            <input type="hidden" name="module_id" value="{{ $module->id }}">
                                            <input class="form-field" name="title" placeholder="Lesson title" required>
                                            <select class="form-field" name="content_type">
                                                <option value="text">Text lesson</option>
                                                <option value="video">Video lesson</option>
                                            </select>
                                            <textarea class="form-field" name="content" placeholder="Lesson content" rows="3"></textarea>
                                            <input class="form-field" name="video_url" type="url" placeholder="Video URL (optional)">
                                            <input class="form-field" name="duration_minutes" type="number" min="1" placeholder="Duration (minutes)" required>
                                            <button class="primary-button small-btn" type="submit">Add lesson</button>
                                        </form>
                                    </details>

                                </div>
                            @endforeach

                            <!-- Collapsible: Add Module -->
                            <details class="add-item-details">
                                <summary>+ Add new module</summary>
                                <form method="POST" action="{{ route('tutor.modules.store', $course) }}" class="stack-form compact-form">
                                    @csrf
                                    <input class="form-field" name="title" placeholder="New module title" required>
                                    <button class="primary-button small-btn" type="submit">Add module</button>
                                </form>
                            </details>

                        </div>
                    </details>

                </article>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#4d42e9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </div>
                    <h2>No courses yet</h2>
                    <p>Your instructor workspace is ready for its first course.</p>
                    <a class="primary-button" href="{{ route('tutor.courses.create') }}">Create your first course</a>
                </div>
            @endforelse
        </div>
    </section>
</x-layouts.app>