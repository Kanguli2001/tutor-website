<x-layouts.app title="Categories - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading"><span class="eyebrow">ADMIN CONSOLE</span>
            <h1>Manage course categories.</h1>
        </div>
        @if (session('status'))
            <div class="form-alert">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('admin.categories.store') }}" class="content-card stack-form">
            <h2>Add category</h2>@csrf<input class="form-field" name="name" placeholder="Category name" required><input
                class="form-field" name="slug" placeholder="category-slug" required><button class="primary-button"
                type="submit">Add category</button>
        </form>
        <div class="management-grid">
            @foreach ($categories as $category)
                <article class="content-card"><strong>{{ $category->name }}</strong><small>{{ $category->slug }}</small>
                </article>
            @endforeach
        </div>
    </section>
</x-layouts.app>
