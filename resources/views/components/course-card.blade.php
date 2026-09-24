<article class="catalog-card"><a class="catalog-image" href="{{ route('courses.show', $course['slug']) }}"><img
            src="{{ asset('images/references/' . $course['image']) }}"
            alt="{{ $course['title'] }}"><span>{{ $course['category'] }}</span></a>
    <div class="catalog-card-body">
        <div class="stars">★★★★★ <small>({{ $course['rating'] }})</small></div>
        <h3><a href="{{ route('courses.show', $course['slug']) }}">{{ $course['title'] }}</a></h3>
        <p>{{ $course['description'] }}</p>
        <div class="catalog-details"><span>◷ &nbsp;{{ $course['duration'] }}</span><span>♧ &nbsp;{{ $course['lessons'] }}
                lessons</span><strong>${{ $course['price'] }}</strong></div>
    </div>
</article>
