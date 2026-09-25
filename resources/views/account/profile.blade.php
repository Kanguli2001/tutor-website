<x-layouts.app title="Profile Settings - Mawey Tutorials">
    <section class="content-page shell">
        
        <div class="page-heading">
            <span class="eyebrow">{{ strtoupper($user->role) }} PROFILE</span>
            <h1>Make your account feel like yours.</h1>
            <p>Edit your personal details, profile picture, and preferences.</p>
        </div>

        @if (session('status'))
            <div class="form-alert">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="form-alert">{{ $errors->first() }}</div>
        @endif

        <div class="profile-layout">
            <!-- LEFT: Profile Preview Card -->
            <aside class="profile-card">
                <div class="profile-card-avatar-wrap">
                    @if ($user->profile_photo_path)
                        <img class="profile-card-avatar" src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}">
                    @else
                        <span class="profile-card-avatar profile-card-initial">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    @endif
                    <div class="profile-card-badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                </div>
                <h2>{{ $user->name }}</h2>
                <p class="profile-card-email">{{ $user->email }}</p>
                <span class="profile-role-badge">{{ strtoupper($user->role) }}</span>
            </aside>

            <!-- RIGHT: Settings Forms -->
            <div class="profile-settings">
                
                <!-- MAIN FORM -->
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="form-card profile-form">
                    @csrf
                    @method('PUT')

                    <!-- Section 1: Personal Info -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <h2>Personal Information</h2>
                            <p>Update your name, email, and profile picture.</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="name">Full Name <span class="required">*</span></label>
                                <input class="form-field" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input class="form-field" id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>

                        <div class="form-group form-group-full">
                            <label for="profile_photo">Profile Picture</label>
                            <input class="form-field file-input" id="profile_photo" type="file" name="profile_photo" accept="image/jpeg,image/png,image/webp">
                            <small class="form-hint">JPG, PNG or WebP. Max 2MB.</small>
                        </div>
                    </div>

                    <!-- Section 2: Preferences -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <h2>Preferences</h2>
                            <p>Choose how Mawey communicates with you.</p>
                        </div>

                        <label class="toggle-row">
                            <input type="checkbox" name="notifications_enabled" value="1" @checked($user->notifications_enabled)>
                            <span class="toggle-label">
                                <strong>Learning updates</strong>
                                <small>Receive emails about new courses and your progress.</small>
                            </span>
                        </label>
                    </div>

                    <div class="form-actions">
                        <button class="primary-button" type="submit">Save Changes</button>
                    </div>
                </form>

                <!-- DANGER ZONE -->
                <form method="POST" action="{{ route('profile.delete') }}" class="form-card danger-zone">
                    @csrf
                    @method('DELETE')

                    <div class="danger-zone-header">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                        <div>
                            <h2>Danger Zone</h2>
                            <p>Once you delete your account, there is no going back. This will permanently remove your account and all learning data.</p>
                        </div>
                    </div>

                    <div class="danger-zone-form">
                        <div class="form-group">
                            <label for="delete_password">Confirm with your password <span class="required">*</span></label>
                            <input class="form-field" id="delete_password" type="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <button class="danger-button" type="submit">Permanently Delete Account</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</x-layouts.app>