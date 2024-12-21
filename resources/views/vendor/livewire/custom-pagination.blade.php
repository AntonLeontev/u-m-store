@if ($paginator->hasPages())
    <div class="flowers__btn">
        <button wire:click.prevent="seeMore">показать еще</button>
    </div>
    <nav>
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    {{--                        <img src="{{ asset('images/next.svg') }}" alt="arrow">--}}
                </li>
            @else
                <li>
                    <a href="#" dusk="previousPage" wire:click.prevent="previousPage" wire:loading.attr="disabled"
                       rel="prev" aria-label="@lang('pagination.previous')">
                        <img src="{{ asset('images/before.svg') }}" alt="arrow">
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active__page" wire:key="paginator-page-{{ $page }}" aria-current="page">
                                <span>{{ $page }}</span></li>
                        @else
                            <li wire:key="paginator-page-{{ $page }}"><a href="#"
                                                                         wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="#" dusk="nextPage" wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                       aria-label="@lang('pagination.next')">
                        <img src="{{ asset('images/next.svg') }}" alt="arrow">
                    </a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    {{--                        <span  aria-hidden="true">&rsaquo;</span>--}}
                </li>
            @endif
        </ul>
    </nav>

@endif

