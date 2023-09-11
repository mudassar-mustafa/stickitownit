@if ($paginator->hasPages())

    <div class="row">
        <div class="col-xl-10">
            <div class="cp-pagination mt-20">
                <nav>
                    <ul>
                        @if ($paginator->onFirstPage())
                            <li class="disabled" aria-disabled="true">
                                <a href="javascript:void(0)">
                                    <i class="fas fa-long-arrow-left"></i>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $paginator->previousPageUrl() }}"
                                   rel="prev"> <i class="fas fa-long-arrow-left"></i></a>
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
                                        <li aria-current="page"><span class="current">{{ $page }}</span></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach


                        @if ($paginator->hasMorePages())
                            <li class="disabled" aria-disabled="true">
                                <a href="{{ $paginator->nextPageUrl() }}">
                                    <i class="fas fa-long-arrow-right"></i>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="javascript:void(0)"
                                   rel="prev"> <i class="fas fa-long-arrow-right"></i></a>
                            </li>
                        @endif


                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endif
