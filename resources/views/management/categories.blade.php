<x-layouts.app title="Categories - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading">
            <span class="eyebrow">ADMIN CONSOLE</span>
            <h1>Manage course categories.</h1>
            <p>Organize your course catalog by adding and managing categories.</p>
        </div>

        @if (session('status'))
            <div class="form-alert">{{ session('status') }}</div>
        @endif

        <!-- Compact Add Category Form -->
        <div class="add-category-container">
            <h2>Add New Category</h2>
            <form method="POST" action="{{ route('admin.categories.store') }}" class="add-category-form">
                @csrf
                <input class="form-field" name="name" placeholder="Category name (e.g. Web Development)" required>
                <input class="form-field" name="slug" placeholder="category-slug (e.g. web-dev)" required>
                <button class="primary-button" type="submit">Add Category</button>
            </form>
        </div>

        <!-- Category List -->
        <div class="category-list-container">
            <div class="list-header">
                <h2>Existing Categories</h2>
                <span class="badge">{{ $categories->count() ?? 0 }} items</span>
            </div>
            
            @forelse ($categories as $category)
                <div class="category-list-row">
                    <div class="category-info">
                        <span class="category-name">{{ $category->name }}</span>
                        <span class="category-slug">/{{ $category->slug }}</span>
                    </div>
                    <div class="category-actions">
                        <!-- Placeholder for future edit/delete actions -->
                        <span class="status-badge status-approved">Active</span>
                    </div>
                </div>
            @empty
                <div class="empty-card-state">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                    <p>No categories created yet. Use the form above to add your first category.</p>
                </div>
            @endforelse
        </div>
    </section>
</x-layouts.app>