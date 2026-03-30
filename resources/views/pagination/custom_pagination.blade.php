@if ($paginator->hasPages())

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <a href="#" class="disabled">‹</a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}">‹</a>
    @endif

    {{-- Page Numbers --}}
    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a href="#" class="active">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}">
            Next <i class="fa fa-long-arrow-right"></i>
        </a>
    @else
        <a href="#" class="disabled">
            Next <i class="fa fa-long-arrow-right"></i>
        </a>
    @endif

@endif