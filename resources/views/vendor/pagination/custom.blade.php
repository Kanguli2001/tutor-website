@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" style="display: flex; justify-content: center; gap: 6px; margin-top: 35px;">
        
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span style="display: inline-flex; align-items: center; justify-content: center; min-width: 32px; height: 32px; border: 1px solid #eeeef4; border-radius: 5px; color: #ccc;">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="display: inline-flex; align-items: center; justify-content: center; min-width: 32px; height: 32px; border: 1px solid #eeeef4; border-radius: 5px; color: #4d42e9; text-decoration: none;">&lsaquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span style="display: inline-flex; align-items: center; justify-content: center; min-width: 32px; height: 32px;">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="display: inline-flex; align-items: center; justify-content: center; min-width: 32px; height: 32px; border: 1px solid #4d42e9; border-radius: 5px; background: #4d42e9; color: #fff; font-weight: 600;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="display: inline-flex; align-items: center; justify-content: center; min-width: 32px; height: 32px; border: 1px solid #eeeef4; border-radius: 5px; color: #1d1e36; text-decoration: none;">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" style="display: inline-flex; align-items: center; justify-content: center; min-width: 32px; height: 32px; border: 1px solid #eeeef4; border-radius: 5px; color: #4d42e9; text-decoration: none;">&rsaquo;</a>
        @else
            <span style="display: inline-flex; align-items: center; justify-content: center; min-width: 32px; height: 32px; border: 1px solid #eeeef4; border-radius: 5px; color: #ccc;">&rsaquo;</span>
        @endif
    </nav>
@endif