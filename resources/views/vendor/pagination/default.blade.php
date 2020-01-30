@if ($paginator->hasPages())
    <nav class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="button is-disabled">Previous page</a>
        @else
            <a class="button" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous page</a>
        @endif

         {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
           <a class="button" href="{{ $paginator->nextPageUrl() }}" rel="next">Next page</a>
        @else
             <a class="button is-disabled">Next page</a>
        @endif
        
        <ul>
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="button is-disabled">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a class="button is-primary">{{ $page }}</a></li>
                        @else
                            <li><a class="button" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>

       
    </nav>
@endif
