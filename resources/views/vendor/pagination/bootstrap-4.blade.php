<style>
    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: var(--main-color);
        border-color: var(--main-color);
    }

    .page-item:not(:first-child) .page-link {
        margin-left: inherit;
    }
</style>
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link prev page-numbers p-0" aria-hidden="true"><i
                            class="ri-arrow-left-s-line"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link prev page-numbers p-0" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       aria-label="@lang('pagination.previous')"><i class="ri-arrow-left-s-line"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span
                            class="page-link page-numbers p-0">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span
                                    class="page-link page-numbers p-0">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link page-numbers p-0"
                                                     href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link next page-numbers p-0" href="{{ $paginator->nextPageUrl() }}" rel="next"
                       aria-label="@lang('pagination.next')"><i class="ri-arrow-right-s-line"></i></a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link next page-numbers p-0" aria-hidden="true"><i
                            class="ri-arrow-right-s-line"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
