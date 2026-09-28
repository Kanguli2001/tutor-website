<x-layouts.app title="Tutorials - Mawey Tutorials" active="tutorials">
    <div class="tutorial-page shell">

        {{-- FEATURED TUTORIAL --}}
        @if($featured)
            <section class="tutorial-feature">
                <div class="tutorial-feature-image">
                    <img src="{{ asset('images/references/' . $featured->image) }}"
                         alt="{{ $featured->title }}">
                    <span class="play-button">▶</span>
                    <span class="featured-tag">Featured Today</span>
                </div>
                <div class="tutorial-feature-copy">
                    <span class="eyebrow">{{ strtoupper($featured->category) }}</span>
                    <h1>{{ $featured->title }}</h1>
                    <p>{{ $featured->description }}</p>
                    <div class="author-row">
                        @if($featured->author_photo)
                            <img src="{{ asset('images/references/' . $featured->author_photo) }}"
                                 alt="{{ $featured->author_name }}">
                        @endif
                        <span>
                            <b>{{ $featured->author_name ?? 'Mawey Team' }}</b>
                            <small>{{ $featured->author_title ?? 'Instructor' }}</small>
                        </span>
                    </div>
                    <a class="watch-button" href="#latest">Watch Tutorial　→</a>
                </div>
            </section>
        @endif

        {{-- LISTING --}}
        <section class="tutorial-listing" id="latest">
            <aside class="topic-sidebar">
                <details class="topic-dropdown">
                    <summary class="topic-dropdown-toggle">
                        <span>Browse Topics</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </summary>

                    <div class="topic-dropdown-body">
                        <a class="active" href="#">All Tutorials <span>{{ $totalTutorials }}</span></a>
                        @foreach($categoryCounts as $cat)
                            <a href="#">{{ $cat->category }} <span>{{ $cat->total }}</span></a>
                        @endforeach
                    </div>
                </details>

                <div class="update-card">
                    <h4>Get Weekly Updates</h4>
                    <p>New tutorials delivered straight to your inbox.</p>
                    <input placeholder="Email address">
                    <button>Subscribe</button>
                </div>
            </aside>

            <div>
                <div class="tutorial-heading">
                    <h2>Latest Tutorials</h2>
                    <span>Sort by:　<b>Newest First⌄</b></span>
                </div>

                <div class="tutorial-grid" id="tutorial-grid">
                    @include('partials.tutorial-cards', ['tutorials' => $tutorials])
                </div>

                <button
                    class="tutorial-more"
                    id="load-more-btn"
                    data-next-url="{{ $tutorials->nextPageUrl() }}"
                    @if(!$tutorials->hasMorePages()) style="display:none;" @endif
                >
                    Load More Tutorials
                </button>
            </div>
        </section>
    </div>

    <section class="tutorial-dark-footer">
        <div class="shell">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-icon">✦</span>Mawey Tutorials
            </a>
            <p>The best free educational content for developers and<br>designers, updated daily.</p>
        </div>
    </section>
</x-layouts.app>