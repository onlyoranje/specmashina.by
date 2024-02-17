{{--<div class="pagination left">
    <ul class="pagination-list">
        <li><a href="javascript:void(0)">1</a></li>
        <li class="active"><a href="javascript:void(0)">2</a></li>
        <li><a href="javascript:void(0)">3</a></li>
        <li><a href="javascript:void(0)">4</a></li>
        <li><a href="javascript:void(0)"><i class="lni lni-chevron-right"></i></a></li>
    </ul>
</div>--}}
@if ($paginator->hasPages())


    <div class="pagination left">
        <ul class="pagination-list">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li  aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a aria-hidden="true">&lsaquo;</a>
                </li>
            @else
                <li>
                    <a  href="{{ $paginator->previousPageUrl() }}"  aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li  aria-disabled="true"><span >{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a>{{ $page }}</a></li>
                        @else
                            <li ><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li >
                    <a  href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li  aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </div>
@endif
