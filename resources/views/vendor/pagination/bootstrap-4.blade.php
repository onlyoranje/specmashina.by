{{--@if ($paginator->hasPages())
    <?php
    $items_count = 3;
    $show_first_item = false;
    $show_last_item = false;

    $limit_start= 1;
    $limit_end= 1;
    if (count($elements[0]) > $items_count*2) {
        $limit_start= $paginator->currentPage() - 1;
        $limit_end= $limit_start + 2;
    }

    if($paginator->currentPage() >= $items_count) {
        $show_first_item= true;
    }
    if($paginator->lastPage() > $paginator->currentPage() + 1) {
        $show_last_item= true;
    }
    ?>
    <div class="pagination left">
        <ul class="pagination-list">

            --}}{{-- Previous Page Link --}}{{--
            @if ($paginator->onFirstPage())
                <li  aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a aria-hidden="true">&lsaquo;</a>
                </li>
            @else
                <li>
                    <a  href="{{ $paginator->previousPageUrl() }}"  aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif
            @foreach ($elements as $element)
                --}}{{-- "Three Dots" Separator --}}{{--
                @if (is_string($element))
                    <li class="disabled"><span class="">{{ $element }}</span></li>
                @endif

                --}}{{-- Array Of Links --}}{{--
                @if (is_array($element))

                    @foreach ($element as $page => $url)

                        @if($show_first_item and $page == 1)
                            <li class=""><a class="" href="{{ $url }}">{{ $page }}</a></li>
                            @if($paginator->currentPage()!= 3)
                                <li class="disabled"><a class="">...</a></li>
                            @endif
                        @endif

                        @if($page >= $limit_start and $page <= $limit_end)
                            @if ($page == $paginator->currentPage())
                                <li class="active"><a href=""><span class="">{{ $page }}</span></a></li>
                            @else
                                <li class=""><a class="" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endif

                        @if($show_last_item and $page == $paginator->lastPage())
                            @if($paginator->currentPage()!= $paginator->lastPage()-2)
                                <li class="disabled"><a class="">...</a></li>
                            @endif
                            <li class=""><a class="" href="{{ $url }}">{{ $page }}</a></li>
                        @endif

                    @endforeach

                @endif
            @endforeach
            --}}{{-- Next Page Link --}}{{--
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

@endif--}}
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
    </nav>
@endif
