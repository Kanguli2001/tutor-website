<x-layouts.app title="Create Course - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading"><span class="eyebrow">INSTRUCTOR HUB</span>
            <h1>Create a course.</h1>
            <p>Start with the essentials. You can add lessons from the instructor workspace.</p>
        </div>
        <form method="POST" action="{{ route('tutor.courses.store') }}" class="content-card stack-form">
            @csrf<label>Title<input class="form-field" name="title" required></label><label>URL slug<input
                    class="form-field" name="slug" required></label><label>Category<input class="form-field"
                    name="category" required></label><label>Level<input class="form-field" name="level"
                    required></label><label>Price in cents<input class="form-field" type="number" name="price_cents"
                    min="0" required></label><label>Description
                <textarea class="form-field" name="description" rows="6" required></textarea>
            </label><button class="primary-button" type="submit">Create draft</button></form>
    </section>
</x-layouts.app>
