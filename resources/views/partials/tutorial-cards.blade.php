@foreach ($tutorials as $tutorial)
    <article class="tutorial-card">
        <a class="tutorial-card-image" href="#">
            <img src="{{ asset('images/references/' . $tutorial->image) }}"
                 alt="{{ $tutorial->title }}">
            <i>{{ $tutorial->duration }}</i>
        </a>
        <div class="tutorial-card-meta">
            <b>{{ $tutorial->category }}</b>{{ $tutorial->published_at?->diffForHumans() }}
        </div>
        <h3>{{ $tutorial->title }}</h3>
        <p>{{ $tutorial->description }}</p>
    </article>
@endforeach