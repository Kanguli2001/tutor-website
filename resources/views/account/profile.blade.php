<x-layouts.app title="Profile Settings - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading">
            <span class="eyebrow">{{ strtoupper($user->role) }} PROFILE</span>
            <h1>Make your account feel like yours.</h1>
            <p>Edit your personal details, profile picture, and learning preferences.</p>
        </div>
        @if (session('status'))
            <div class="form-alert">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="form-alert">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
            class="content-card stack-form contact-form">
            <div class="profile-photo-wrap">
                @if ($user->profile_photo_path)
                    <img class="profile-photo" src="{{ asset('storage/' . $user->profile_photo_path) }}"
                        alt="{{ $user->name }}">
                @else
                    <span class="profile-photo profile-initial">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                @endif
            </div>
            <label>Profile picture
                <input class="form-field" type="file" name="profile_photo" accept="image/jpeg,image/png,image/webp">
            </label>
            <label>Full name
                <input class="form-field" name="name" value="{{ old('name', $user->name) }}" required>
            </label>
            <label>Email
                <input class="form-field" type="email" name="email" value="{{ old('email', $user->email) }}"
                    required>
            </label>
            <label class="check-row">
                <input type="checkbox" name="notifications_enabled" value="1" @checked($user->notifications_enabled)>
                Receive learning updates
            </label>
            <button class="primary-button" type="submit">Save profile</button>
        </form>
        <form method="POST" action="{{ route('profile.delete') }}" class="content-card stack-form">
            @csrf
            @method('DELETE')
            <h2>Delete account</h2>
            <p>This permanently removes your account and learning data.</p>
            <label>Confirm with your password
                <input class="form-field" type="password" name="password" required>
            </label>
            <button class="secondary-button" type="submit">Delete account</button>
        </form>
    </section>
</x-layouts.app>
