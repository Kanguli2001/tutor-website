<x-layouts.app title="User Management - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading"><span class="eyebrow">ADMIN CONSOLE</span>
            <h1>Manage users and roles.</h1>
        </div>
        <div class="management-grid">
            @foreach ($users as $user)
                <article class="content-card">
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->email }} · {{ $user->enrollments_count }} enrollments</p>
                    <form method="POST" action="{{ route('admin.users.role', $user) }}" class="stack-form">@csrf
                        @method('PUT')<select class="form-field" name="role">
                            <option value="student" @selected($user->role === 'student')>Student</option>
                            <option value="tutor" @selected($user->role === 'tutor')>Tutor</option>
                            <option value="admin" @selected($user->role === 'admin')>Admin</option>
                        </select><button class="secondary-button" type="submit">Save role</button></form>
                </article>
            @endforeach
        </div>{{ $users->links() }}
    </section>
</x-layouts.app>
