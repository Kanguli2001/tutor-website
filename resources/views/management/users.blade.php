<x-layouts.app title="User Management - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading">
            <span class="eyebrow">ADMIN CONSOLE</span>
            <h1>Manage users and roles.</h1>
            <p>Review accounts, manage permissions, and track enrollment activity.</p>
        </div>

        <!-- Toolbar: Search & Count -->
        <div class="user-management-toolbar">
            <div class="search-box">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" placeholder="Search users by name or email...">
            </div>
            <span class="user-count">{{ $users->total() }} Total Users</span>
        </div>

        <!-- User List -->
        <div class="user-list-container">
            @foreach ($users as $user)
                <div class="user-list-row">
                    
                    <!-- Left: Avatar & Info -->
                    <div class="user-info-group">
                        <div class="user-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="user-details">
                            <span class="user-name">{{ $user->name }}</span>
                            <span class="user-email">{{ $user->email }}</span>
                        </div>
                    </div>

                    <!-- Middle: Stats -->
                    <div class="user-stats-group">
                        <span class="enrollment-badge">{{ $user->enrollments_count }} Enrollments</span>
                    </div>

                    <!-- Right: Actions -->
                    <div class="user-actions-group">
                        <form method="POST" action="{{ route('admin.users.role', $user) }}" class="role-form">
                            @csrf
                            @method('PUT')
                            <select class="role-select" name="role">
                                <option value="student" @selected($user->role === 'student')>Student</option>
                                <option value="tutor" @selected($user->role === 'tutor')>Tutor</option>
                                <option value="admin" @selected($user->role === 'admin')>Admin</option>
                            </select>
                            <button class="primary-button small-btn" type="submit">Update</button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>

        <!-- Pagination Wrapper (Safely contained) -->
        <div class="pagination-wrapper">
            {{ $users->links() }}
        </div>
    </section>
</x-layouts.app>