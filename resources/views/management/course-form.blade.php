<x-layouts.app title="Create Course - Mawey Tutorials">
    <section class="content-page shell">
        
        <!-- Page Header -->
        <div class="page-heading">
            <span class="eyebrow">INSTRUCTOR HUB</span>
            <h1>Create a course.</h1>
            <p>Start with the essentials. You can add modules and lessons from the workspace once the draft is created.</p>
        </div>

        <!-- Form Card -->
        <form method="POST" action="{{ route('tutor.courses.store') }}" class="form-card">
            @csrf

            <!-- Section 1: Basic Information -->
            <div class="form-section">
                <div class="form-section-header">
                    <h2>Basic Information</h2>
                    <p>Give your course a title and a URL-friendly slug.</p>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="title">Course Title <span class="required">*</span></label>
                        <input class="form-field" id="title" name="title" placeholder="e.g. Advanced React Masterclass" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="slug">URL Slug <span class="required">*</span></label>
                        <input class="form-field" id="slug" name="slug" placeholder="e.g. advanced-react-masterclass" required>
                        <small class="form-hint">Use lowercase letters and hyphens only.</small>
                    </div>
                </div>
            </div>

            <!-- Section 2: Classification -->
            <div class="form-section">
                <div class="form-section-header">
                    <h2>Classification</h2>
                    <p>Help learners find your course by categorizing it.</p>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="category">Category <span class="required">*</span></label>
                        <input class="form-field" id="category" name="category" placeholder="e.g. Web Development" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="level">Level <span class="required">*</span></label>
                        <input class="form-field" id="level" name="level" placeholder="e.g. Beginner, Intermediate, Advanced" required>
                    </div>
                </div>
            </div>

            <!-- Section 3: Pricing -->
            <div class="form-section">
                <div class="form-section-header">
                    <h2>Pricing</h2>
                    <p>Set the price for your course. Use 0 for a free course.</p>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="price_cents">Price (in cents) <span class="required">*</span></label>
                        <div class="input-with-prefix">
                            <span class="input-prefix">$</span>
                            <input class="form-field" id="price_cents" type="number" name="price_cents" min="0" placeholder="4900" required>
                        </div>
                        <small class="form-hint">Example: 4900 = $49.00</small>
                    </div>
                </div>
            </div>

            <!-- Section 4: Description -->
            <div class="form-section">
                <div class="form-section-header">
                    <h2>Description</h2>
                    <p>Describe what learners will gain from this course.</p>
                </div>
                
                <div class="form-group">
                    <label for="description">Course Description <span class="required">*</span></label>
                    <textarea class="form-field" id="description" name="description" rows="6" placeholder="In this course, learners will..." required></textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a class="secondary-button" href="{{ route('tutor.dashboard') }}">Cancel</a>
                <button class="primary-button" type="submit">Create draft</button>
            </div>
        </form>
    </section>
</x-layouts.app>