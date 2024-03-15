
@if ($paginator->hasPages())
    <div class="pagination left">
        <ul class="pagination-list"">
            @if ($paginator->onFirstPage())
                <li >
                    <a  href="#"
                       tabindex="-1">&lsaquo;</a>
                </li>
            @else
                <li><a
                                         href="{{ $paginator->previousPageUrl() }}">
                        &lsaquo;</a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active">
                                <a>{{ $page }}</a>
                            </li>
                        @else
                            <li>
                                <a
                                   href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a
                       href="{{ $paginator->nextPageUrl() }}"
                       rel="next">&rsaquo;</a>
                </li>
            @else
                <li>
                    <a  href="#">&rsaquo;</a>
                </li>
            @endif
        </ul>
    </div>
@endif
