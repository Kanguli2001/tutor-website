<x-layouts.app title="Tutorials - Mawey Tutorials" active="tutorials">
    <div class="tutorial-page shell">
        <section class="tutorial-feature">
            <div class="tutorial-feature-image"><img src="{{ asset('images/references/bb0c4c4d-1.jpg') }}"
                    alt="Mastering CSS Grid"><span class="play-button">▶</span><span class="featured-tag">Featured
                    Today</span></div>
            <div class="tutorial-feature-copy"><span class="eyebrow">FRONTEND DEVELOPMENT</span>
                <h1>Mastering CSS Grid:<br>The Ultimate Layout<br>System for 2026</h1>
                <p>Stop using complex hacks for layouts. Learn how to leverage CSS Grid to build responsive, robust, and
                    clean web structures in under 20 minutes.</p>
                <div class="author-row"><img src="{{ asset('images/references/bb0c4c4d-0.jpg') }}"
                        alt="Alex Thompson"><span><b>Alex Thompson</b><small>Senior Web Architect</small></span></div><a
                    class="watch-button" href="#latest">Watch Tutorial　→</a>
            </div>
        </section>
        <section class="tutorial-listing" id="latest">
            <aside class="topic-sidebar">
                <h3>Browse Topics</h3><a class="active" href="#">All Tutorials <span>42</span></a><a
                    href="#">React & Next.js <span>12</span></a><a href="#">Tailwind CSS
                    <span>8</span></a><a href="#">Figma Design <span>15</span></a><a href="#">TypeScript
                    <span>7</span></a>
                <div class="update-card">
                    <h4>Get Weekly Updates</h4>
                    <p>New tutorials delivered straight to your inbox.</p><input
                        placeholder="Email address"><button>Subscribe</button>
                </div>
            </aside>
            <div>
                <div class="tutorial-heading">
                    <h2>Latest Tutorials</h2><span>Sort by:　<b>Newest First⌄</b></span>
                </div>
                <div class="tutorial-grid">
                    @foreach ($tutorials as $tutorial)
                        <article class="tutorial-card"><a class="tutorial-card-image" href="#"><img
                                    src="{{ asset('images/references/' . $tutorial['image']) }}"
                                    alt="{{ $tutorial['title'] }}"><i>{{ $tutorial['duration'] }}</i></a>
                            <div class="tutorial-card-meta"><b>{{ $tutorial['category'] }}</b>{{ $tutorial['age'] }}
                            </div>
                            <h3>{{ $tutorial['title'] }}</h3>
                            <p>{{ $tutorial['description'] }}</p>
                        </article>
                    @endforeach
                </div><button class="tutorial-more">Load More Tutorials</button>
            </div>
        </section>
    </div>
    <section class="tutorial-dark-footer">
        <div class="shell"><a class="brand" href="{{ route('home') }}"><span class="brand-icon">✦</span>Mawey
                Tutorials</a>
            <p>The best free educational content for developers and<br>designers, updated daily.</p>
        </div>
    </section>
</x-layouts.app>
